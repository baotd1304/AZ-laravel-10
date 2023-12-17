<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreUserRequest;
use App\Http\Requests\admin\UpdateUserRequest;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;
    protected $postCatalogueService;

    public function __construct(
        PostService $postService,
        PostCatalogueService $postCatalogueService,
    ){
        $this->postService = $postService;
        $this->postCatalogueService = $postCatalogueService;
    }
    public function index(Request $request)
    {
        $posts = $this->postService->pagination($request);
        $postCatalogues = $this->postCatalogueService->getAll();
        return view('admin.post.index', compact(
            'posts',
            'postCatalogues'
        ));
    }
    
    public function create()
    {
        $postCatalogues = $this->postCatalogueService->getAll();
        return view('admin.post.store', compact(
            'postCatalogues',
        ));
    }

    public function store(StoreUserRequest $request)
    {
        if($this->postService->create($request)){
            return redirect()->route('admin.posts.index')->with('success', 'Thêm bài viết mới thành công');
        }
        return redirect()->route('admin.posts.index')->with('error', 'Thêm bài viết mới không thành công. Vui lòng thử lại');
    }
    
    public function edit($id)
    {
        $postCatalogues = $this->postCatalogueService->getAll();
        $post = $this->postService->edit($id);
        // dd($post);
        return view('admin.post.store', compact(
            'post',
            'postCatalogues',
        ));
    }

    public function update($id, UpdateUserRequest $request)
    {
        if($this->postService->update($id, $request)){
            return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài viết ID: '.$id.' thành công');
        }
        return redirect()->route('admin.posts.index')->with('error', 'Cập nhật bài viết ID: '.$id.' không thành công. Vui lòng thử lại');
    }

    public function destroy($id)
    {
        if($this->postService->delete($id)){
            return response()->json(['success' => true, 'message' => 'Đã xóa thành công!']);
        }
    }
}
