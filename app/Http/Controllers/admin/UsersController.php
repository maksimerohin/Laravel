<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\AdminUserService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    protected $adminUserService;

    public function __construct(AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }


    public function __invoke($id)
    {
       // return view('user.profile', ['user' => User::findOrFail($id)]);
        return view('admin.userProfile.index', ['user' => User::findOrFail($id)]);
    }
}
