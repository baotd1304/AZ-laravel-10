<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreUserCatalogueRequest;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    protected $languageService;

    public function __construct(
        LanguageService $languageService,
    ){
        $this->languageService = $languageService;
    }
    public function index(Request $request)
    {
        $languages = $this->languageService->pagination($request);
        
        // dd($languages->postCatalogue);
        // foreach ($languages as $lang){
        //     echo $lang->postCatalogues;
        //     dd($lang->postCatalogues);
        // }
        return view('admin.language.index', compact(
            'languages',
        ));
    }
    
    public function create()
    {
        return view('admin.language.store');
    }

    public function store(StoreUserCatalogueRequest $request)
    {
        if($this->languageService->create($request)){
            return redirect()->route('admin.languages.index')->with('success', 'Thêm ngôn ngữ mới thành công');
        }
        return redirect()->route('admin.languages.index')->with('error', 'Thêm ngôn ngữ mới không thành công. Vui lòng thử lại');
    }
    
    public function edit($id)
    {
        $language = $this->languageService->edit($id);
        // dd($post);
        return view('admin.language.store', compact(
            'language'
        ));
    }

    public function update($id, StoreUserCatalogueRequest $request)
    {
        if($this->languageService->update($id, $request)){
            return redirect()->route('admin.languages.index')->with('success', 'Cập nhật ngôn ngữ ID: '.$id.' thành công');
        }
        return redirect()->route('admin.languages.index')->with('error', 'Cập nhật ngôn ngữ ID: '.$id.' không thành công. Vui lòng thử lại');
    }

    public function destroy($id)
    {
        if($this->languageService->delete($id)){
            return response()->json(['success' => true, 'message' => 'Đã xóa thành công!']);
        }
    }

}
