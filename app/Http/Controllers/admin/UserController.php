<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        
    }
    public function index()
    {
        $config = $this->config();
        return view('admin.user.index', compact('config'));
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
