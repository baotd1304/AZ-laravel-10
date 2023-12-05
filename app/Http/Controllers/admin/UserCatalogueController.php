<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreUserCatalogueRequest;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use Illuminate\Http\Request;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;

    public function __construct(
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository,
    ){
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }
    public function index(Request $request)
    {
        $userCatalogues = $this->userCatalogueService->pagination($request);
        return view('admin.userCatalogue.index', compact(
            'userCatalogues',
        ));
    }
    
    public function create()
    {
        return view('admin.userCatalogue.store');
    }

    public function store(StoreUserCatalogueRequest $request)
    {
        if($this->userCatalogueService->create($request)){
            return redirect()->route('admin.user_catalogue.index')->with('success', 'Thêm nhóm mới thành công');
        }
        return redirect()->route('admin.user_catalogue.index')->with('error', 'Thêm nhóm mới không thành công. Vui lòng thử lại');
    }
    
    public function edit($id)
    {
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        // dd($user);
        return view('admin.userCatalogue.store', compact(
            'userCatalogue'
        ));
    }

    public function update($id, StoreUserCatalogueRequest $request)
    {
        if($this->userCatalogueService->update($id, $request)){
            return redirect()->route('admin.user_catalogue.index')->with('success', 'Cập nhật nhóm thành viên ID: '.$id.' thành công');
        }
        return redirect()->route('admin.user_catalogue.index')->with('error', 'Cập nhật nhóm thành viên ID: '.$id.' không thành công. Vui lòng thử lại');
    }

    public function destroy($id)
    {
        if($this->userCatalogueService->delete($id)){
            return response()->json(['success' => true, 'message' => 'Đã xóa thành công!']);
        }
    }
}
