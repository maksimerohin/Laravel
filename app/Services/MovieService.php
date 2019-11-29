<?php


namespace App\Services;

use App\Base\Service\BaseService;
use App\Base\Service\CD;
use App\Events\MovieEvent;
use App\Helpers\Views\AdminHelpers;
use App\Models\Movie;
use App\Repositories\Interfaces\IMovieRepository;
use App\Repositories\MovieRepository;
use App\Services\Interfaces\IMovieService;
use App\Services\Interfaces\IUploadService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;

class MovieService extends BaseService implements IMovieService
{
    protected $uploadService;

    public function __construct(IUploadService $uploadService) {
        parent::__construct();

        $this->uploadService = $uploadService;
    }

    /**
     * проверить данные перед сохранением
     * @param array $data
     * @throws ValidationException
     */
    protected function validateStore(array $data)
    {
        \Illuminate\Support\Facades\Validator::make($data, [
            'name' => ['required', 'max:255'],
            //    'premiere' => ['nu'],
        ])->validate();
    }

    /**
     * @param array $data
     * @return Model
     * @throws ValidationException
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function store(array $data): Model {
        $this->validateStore($data);

        $uploads = $this->uploadService->loadData();
        if(isset($uploads['poster']) && count($uploads['poster'])) {
            $upload_id = $uploads['poster'][0]['id'];
            $data['poster_id'] = $this->uploadService->detachFile($upload_id);
        }
        elseif(array_key_exists('poster', $data)) {
            if($data['poster'] instanceof UploadedFile) {
                $fileModel = $this->uploadService->getFileService()->saveFile($data['poster']);
                $data['poster_id'] = $fileModel->id;
            }
            unset($data['poster']);
        }
        /** @var Movie $movie */
        $movie = $this->getRepository()->createFromArray($data);

        // $this->uploadService->clearCurrent();

        event(new MovieEvent($movie, MovieEvent::STORED));

        return $movie;
    }
    /**
     * проверить данные перед изменением
     * @param Movie $movie
     * @param array $data
     */
    protected function validateUpdate(Movie $movie, array $data)
    {
        \Illuminate\Support\Facades\Validator::make($data, [
            'name' => ['sometimes', 'required', 'max:255'],
            //    'premiere' => ['nu'],
        ])->validate();
    }

    /**
     * @param int $itemId
     * @param array $data
     * @return Model
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Exception
     */
    public function update(int $itemId, array $data): Model {
        /** @var Movie $movie */
        $movie = $this->findByID($itemId);

        $this->validateUpdate($movie, $data);
        /** @var MovieRepository $repository */
        $repository = $this->getRepository();

        $uploads = $this->uploadService->loadData();
        $delete_poster = null;
        if(isset($uploads['poster']) && count($uploads['poster'])) {
            $upload_id = $uploads['poster'][0]['id'];
            $data['poster_id'] = $this->uploadService->detachFile($upload_id);
            $delete_poster = $movie->poster;
        }
        elseif(array_key_exists('poster_id', $data)) {
            if(empty($data['poster_id']))
                $delete_poster = $movie->poster;
        }

        /** @var Movie $movie */
        $movie = $repository->updateFromArray($movie, $data);
        if($delete_poster) {
            $this->uploadService->getFileService()->removeFile($delete_poster);
        }

        $this->uploadService->clearCurrent();

        event(new MovieEvent($movie, MovieEvent::UPDATED));

        return $movie;
    }
    /**
     * проверить данные перед удалением
     * @param Movie $movie
     */
    protected function validateRemove(Movie $movie)
    {
    }

    /**
     * @param int $primary
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Exception
     */
    public function remove(int $primary)
    {
        /** @var Movie $movie */
        $movie = $this->findByID($primary);

        $this->validateRemove($movie);

        event(new MovieEvent($movie, MovieEvent::DELETING));
        $delete_poster = $movie->poster;
        parent::remove($primary);

        if($delete_poster)
            $this->uploadService->getFileService()->removeFile($delete_poster);
    }
    /**
     * Получить ближайшие фильмы в прокате
     *
     * @param int $nLastCount
     * @param CD|null $cache
     * @return array
     * @throws \Exception
     */
    public function getSoonInRental(int $nLastCount): array {
        /** @var IMovieRepository $repository */
        $result = [];
        $repository = $this->getRepository();
        $repository->getSoonInRental($nLastCount)->map(
            function($movie) use (&$result) {
                /** @var Movie $movie */
                $item = $movie->toArray();
                $item['poster'] = $movie->poster->toArray();
                $item['premiereDate'] = AdminHelpers::Date_db_site($item['premiereDate']);
                $result[] = $item;
            }
        );

        return $result;
    }

    /**
     * Получить $nCount случайных фильмов находящихся в данный момент в прокате
     *
     * @param int $nCount
     * @return array
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getInRentalRand(int $nCount): array {
        /** @var IMovieRepository $repository */
        $result = [];
        $repository = $this->getRepository();
        $repository->getInRentalRand($nCount)->map(
            function($movie) use (&$result) {
                /** @var Movie $movie */
                $item = $movie->toArray();
                $item['poster'] = $movie->poster->toArray();
                $result[] = $item;
            }
        );

        return $result;
    }
}

