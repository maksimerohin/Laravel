<?php


namespace App\Base\Controller;

use App\Http\Controllers\Controller;
use App\Services\FileService;
use App\Services\Interfaces\IUploadService;
use App\Services\ResizeService;
use Illuminate\Container\Container;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
// use Psr\Log\LoggerAwareInterface;

/**
 * Содержит ссылки на базовые сервисы
 * Управление правами, оповещениями
 *
 * Class AbstractController
 * @package App\Base\Controller
 */

abstract class AbstractController extends Controller
{
    /**
     * @var ResizeService
     */
    protected $resizeService;
    /**
     * @var IUploadService
     */
    protected $uploadService;

    /**
     * если передается команда в переменной cmd ищем и вызываем метод в контроллере по шаблону cmd<cmd>.
     * @return RedirectResponse|null
     */
    private function dispatchCmd(): ?RedirectResponse {
        $request = request();
        $cmd = $request->get('_cmd');
        $returnTo = $request->get('_returnTo', $request->getUri());
        $cmdMethod = 'cmd' . $cmd;
        $hasCmdMethod = !empty($cmd) && method_exists($this, $cmdMethod);
        $response = null;

        if($hasCmdMethod) {
            $container = Container::getInstance();
            try {
                $result = $container->call([$this, $cmdMethod]);
                /** @var RedirectResponse $response */
                if($response instanceof RedirectResponse)
                    $response = $result;
                elseif(is_string($result))
                    $response = redirect($result, 302);
                else
                    $response = redirect($returnTo, 302);
            }
            catch (ValidationException $exception) {
                $response = redirect($returnTo, 302)->withErrors($exception->errors());
            }
            catch (\Exception $exception) {
                $response = redirect($returnTo, 302)->withErrors($exception->getMessage());
            }

            return $response->withInput()->exceptInput('_returnTo', '_cmd');
        }

        return $response;
    }
    /**
     * @param string $method
     * @param array $parameters
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response|null
     */
    public function callAction($method, $parameters)
    {
        $this->prepareAction($method, $parameters);

        $cmdResponse = $this->dispatchCmd();
        if($cmdResponse !== null)
            return $cmdResponse;

        return parent::callAction($method, $parameters);
    }
    /**
     * @param $method
     * @param $parameters
     */
    public function prepareAction($method, $parameters): void {
    }
    /**
     * @param string $message
     * @param string $key
     */
    protected function status(string $message, string $key = 'statusMessage') {
        request()->session()->flash($key, $message);
    }

    public function Resizer(): ResizeService {
        if(!$this->resizeService)
            $this->resizeService = app()->make(ResizeService::class);
        return $this->resizeService;
    }

    public function Uploader(): IUploadService {
        if(!$this->uploadService)
            $this->uploadService = app()->make(IUploadService::class);
        return $this->uploadService;
    }
    public function FileService(): FileService {
        return $this->Uploader()->getFileService();
    }

    public function makeThumbs(array &$data, string $field, array $thumbOpts = null) {
        foreach ($data as &$item)
            $this->makeThumb($item, $field, $thumbOpts);
    }

    public function makeThumb(array &$item, string $field, array $thumbOpts = null) {
        $fs = $this->FileService();
        $rs = $this->Resizer();
        $bOneImage = (substr($field, -1, 1) != 's');

        if(!array_key_exists($field, $item) || empty($item[$field]))
            return;

        $key = $field . '_thumb';
        if($bOneImage) {
            $item[$field] = $fs->getLocalFileArray($item[$field]);
            $item[$field.'_url'] = $item[$field] ? $fs->getAssetFile($item[$field]) : null;
            if($thumbOpts) {
                $item[$key] = $item[$field] ? $rs->ResizeImage($item[$field] , $thumbOpts) : null;
                $item[$key . '_url'] = $item[$key] ? $fs->getAssetFile($item[$key]) : null;
            }
        }
        else {
            $item[$field.'_url'] = [];
            $item[$key] = [];
            $item[$key.'_url'] = [];
            foreach($item[$field] as $file) {
                $file = $fs->getLocalFileArray($file);
                if($file) {
                    $item[$field.'_url'][] = $fs->getAssetFile($file);
                    $fileResized = $rs->ResizeImage($file, $thumbOpts);
                    $item[$key][] = $fileResized;
                    $item[$key.'_url'][] = $fs->getAssetFile($fileResized);
                }
            }
        }
    }
}
