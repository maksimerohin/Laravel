<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Group;
use App\Services\Users\UsersService;

class Clients extends Controller
{
    /**
     * @var UsersService
     */
    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $list = $this->usersService->searchUsers(Group::CLIENTS);
        $list->load('group');

        return view('clients.index')->with([
            'user' => ['id' => 1], // @todo
            'currentPage' => 'clients',
            'list' => $list,
            'title' => __("clients/general.title")
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('clients.create')->with([
            'user' => ['id' => 1], // @todo
            'currentPage' => 'clients',
            'title' => __("clients/create.title")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUserRequest $request)
    {
        $data = array_merge(
            $request->getFormData(),
            ['group_id' => Group::CLIENTS[0]]
        );

        $this->usersService->storeUser($data);

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $client = $this->usersService->findUser($id);
        return view('clients.show')->with([
            'user' => ['id' => 1], // @todo
            'client' => $client,
            'currentPage' => 'clients',
            'title' => $client->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $client = $this->usersService->findUser($id);
        return view('clients.edit')->with([
            'user' => ['id' => 1], // @todo
            'client' => $client,
            'currentPage' => 'clients',
            'title' => __("clients/edit.title")
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param int               $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $client = $this->usersService->findUser($id);

        if (!$client) {
            abort(404);
        }

        $this->usersService->updateUser($client, $request->getFormData());

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $client = $this->usersService->findUser($id);

        if (!$client) {
            abort(404);
        }

        $this->usersService->deleteUser($client);

        return redirect(route('clients.index'));
    }
}
