<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreUserRequest;
use App\Http\Requests\admin\UpdateUserRequest;
use App\Services\Interfaces\ProvinceServiceInterface as ProvinceService;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    protected $userCatalogueService;
    protected $provinceService;

    public function __construct(
        UserService $userService,
        UserCatalogueService $userCatalogueService,
        ProvinceService $provinceService,
    ){
        $this->userService = $userService;
        $this->userCatalogueService = $userCatalogueService;
        $this->provinceService = $provinceService;
    }
    public function index(Request $request)
    {
        $users = $this->userService->pagination($request);
        // dd($users);
        $userCatalogues = $this->userCatalogueService->getAll();
        return view('admin.user.index', compact(
            'users',
            'userCatalogues'
        ));
    }
    
    public function create()
    {
        $provinces = $this->provinceService->getAll();
        $userCatalogues = $this->userCatalogueService->getAll();
        return view('admin.user.store', compact(
            'provinces',
            'userCatalogues',
        ));
    }

    public function store(StoreUserRequest $request)
    {
        if($this->userService->create($request)){
            return redirect()->route('admin.users.index')->with('success', 'Thêm tài khoản mới thành công');
        }
        return redirect()->route('admin.users.index')->with('error', 'Thêm tài khoản mới không thành công. Vui lòng thử lại');
    }
    
    public function edit($id)
    {
        $provinces = $this->provinceService->getAll();
        $userCatalogues = $this->userCatalogueService->getAll();
        $user = $this->userService->edit($id);
        // dd($user);
        return view('admin.user.store', compact(
            'provinces',
            'user',
            'userCatalogues',
        ));
    }

    public function update($id, UpdateUserRequest $request)
    {
        if($this->userService->update($id, $request)){
            return redirect()->route('admin.users.index')->with('success', 'Cập nhật tài khoản ID: '.$id.' thành công');
        }
        return redirect()->route('admin.users.index')->with('error', 'Cập nhật tài khoản ID: '.$id.' không thành công. Vui lòng thử lại');
    }

    public function destroy($id)
    {
        if($this->userService->delete($id)){
            return response()->json(['success' => true, 'message' => 'Đã xóa thành công!']);
        }
    }
}
