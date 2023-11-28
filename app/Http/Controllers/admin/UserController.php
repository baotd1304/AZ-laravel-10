<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface as UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = $this->userService->paginate();
        $config = $this->config();
        return view('admin.user.index', compact(
            'config', 
            'users',
        ));
    }
    
    public function create()
    {
        $config = $this->config();
        return view('admin.user.create', compact(
            'config',
        ));
    }

    private function config()
    {
        return [
            'js' => [
                "{{asset('admin/js/plugins/switchery/switchery.js')}}"
            ],
            'css' => [
                "{{asset('admin/css/plugins/switchery/switchery.css')}}"
            ],
        ];
    }
}
