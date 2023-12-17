<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\PostCatalogueRequest;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use Illuminate\Http\Request;

class PostCatalogueController extends Controller
{
    protected $postCatalogueService;
    protected $postCatalogueRepository;

    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository,
    ){
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;
    }
    public function index(Request $request)
    {
        $postCatalogues = $this->postCatalogueService->pagination($request);
        // dd($postCatalogues);
       

        return view('admin.postCatalogue.index', compact(
            'postCatalogues',
        ));
    }
    
    public function create()
    {
        return view('admin.postCatalogue.store');
    }

    public function store(PostCatalogueRequest $request)
    {
        if($this->postCatalogueService->create($request)){
            return redirect()->route('admin.post_catalogue.index')->with('success', 'Thêm nhóm mới thành công');
        }
        return redirect()->route('admin.post_catalogue.index')->with('error', 'Thêm nhóm mới không thành công. Vui lòng thử lại');
    }
    
    public function edit($id)
    {
        $postCatalogue = $this->postCatalogueRepository->findById($id);
        // dd($post);
        return view('admin.postCatalogue.store', compact(
            'postCatalogue'
        ));
    }

    public function update($id, PostCatalogueRequest $request)
    {
        if($this->postCatalogueService->update($id, $request)){
            return redirect()->route('admin.post_catalogue.index')->with('success', 'Cập nhật nhóm bài viết ID: '.$id.' thành công');
        }
        return redirect()->route('admin.post_catalogue.index')->with('error', 'Cập nhật nhóm bài viết ID: '.$id.' không thành công. Vui lòng thử lại');
    }

    public function destroy($id)
    {
        if($this->postCatalogueService->delete($id)){
            return response()->json(['success' => true, 'message' => 'Đã xóa thành công!']);
        }
    }

}
