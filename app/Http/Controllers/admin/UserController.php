<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreUserRequest;
use App\Http\Requests\admin\UpdateUserRequest;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    protected $userRepository;
    protected $provinceRepository;

    public function __construct(
        UserService $userService,
        UserRepository $userRepository,
        ProvinceRepository $provinceRepository,
    ){
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->provinceRepository = $provinceRepository;
    }
    public function index(Request $request)
    {
        $users = $this->userService->pagination($request);
        $provinces = $this->provinceRepository->getAll();
        return view('admin.user.index', compact(
            'users',
            'provinces'
        ));
    }
    
    public function create()
    {
        $provinces = $this->provinceRepository->getAll();
        return view('admin.user.store', compact(
            'provinces'
        ));
    }

    public function store(StoreUserRequest $request)
    {
        if($this->userService->create($request)){
            return redirect()->route('admin.user.index')->with('success', 'Thêm tài khoản mới thành công');
        }
        return redirect()->route('admin.user.index')->with('error', 'Thêm tài khoản mới không thành công. Vui lòng thử lại');
    }
    
    public function edit($id)
    {
        $provinces = $this->provinceRepository->getAll();
        $user = $this->userRepository->findById($id);
        // dd($user);
        return view('admin.user.store', compact(
            'provinces',
            'user'
        ));
    }

    public function update($id, UpdateUserRequest $request)
    {
        if($this->userService->update($id, $request)){
            return redirect()->route('admin.user.index')->with('success', 'Cập nhật tài khoản ID: '.$id.' thành công');
        }
        return redirect()->route('admin.user.index')->with('error', 'Cập nhật tài khoản ID: '.$id.' không thành công. Vui lòng thử lại');
    }

    public function destroy($id)
    {
        if($this->userService->delete($id)){
            return response()->json(['success' => true, 'message' => 'Đã xóa thành công!']);
        }
    }
}
