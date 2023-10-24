<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;



class AuthController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(){
        return view('admin.auth.login');
    }
    public function login(AuthRequest $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
        }
        return redirect()->route('login')->with('error', 'Email hoặc mật khẩu không chính xác');
    }

    public function logout(Request $request): RedirectResponse {
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/')->with('warning', 'Bạn đã đăng xuất');
    }

    
}
