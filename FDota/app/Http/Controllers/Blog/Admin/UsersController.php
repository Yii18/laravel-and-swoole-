<?php

namespace App\Http\Controllers\blog\admin;

use App\Blog\Services\UserService;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /** @var UserService  */
    protected $userService;

    /**
     * UsersController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $list = $this->userService->all();

        return view('blog.admin.users.list', compact('list'));
    }
}
