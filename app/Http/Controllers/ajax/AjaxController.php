<?php

namespace App\Http\Controllers\ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    
    public function __construct(
    ){
    }
    public function changeStatus(Request $request)
    {
        $post = $request -> input();
        $serviceInterfaceNamespace = 'App\Services\\' . ucfirst($post['model']) . 'Service';
        if (class_exists($serviceInterfaceNamespace)){
            $serviceInstance = app($serviceInterfaceNamespace);
        };
        $result = $serviceInstance->updateStatus($post['id'], $post);
        return response()->json([
            'result' => $result,
            'message' => 'Cập nhật trạng thái mã ID: '.$post['id'].' thành công'
        ]);
    }
    public function changeStatusAll(Request $request)
    {
        $post = $request -> input();
        $serviceInterfaceNamespace = 'App\Services\\' . ucfirst($post['model']) . 'Service';
        // dd($serviceInterfaceNamespace);
        if (class_exists($serviceInterfaceNamespace)){
            $serviceInstance = app($serviceInterfaceNamespace);
        };
        $result = $serviceInstance->updateStatusAll($post);
        return response()->json([
            'result' => $result,
            'message' => 'Cập nhật trạng thái '.count($post['id']).' bản ghi thành công'
        ]);
    }
    public function deleteChecked(Request $request)
    {
        $post = $request -> input();
        $serviceInterfaceNamespace = 'App\Services\\' . ucfirst($post['model']) . 'Service';
        // dd($post);
        if (class_exists($serviceInterfaceNamespace)){
            $serviceInstance = app($serviceInterfaceNamespace);
        };
        $result = $serviceInstance->deleteChecked($post['id']);
        return response()->json([
            'result' => $result,
            'message' => 'Xóa '.count($post['id']).' bản ghi đã chọn thành công'
        ]);
    }

    public function changeFieldSelect(Request $request)
    {
        $post = $request -> input();
        // dd($post);
        $serviceInterfaceNamespace = 'App\Services\\' . ucfirst($post['model']) . 'Service';
        if (class_exists($serviceInterfaceNamespace)){
            $serviceInstance = app($serviceInterfaceNamespace);
        };
        $result = $serviceInstance->changeFieldSelect($post);
        return response()->json([
            'result' => $result,
            'message' => 'Cập nhật thông tin mã ID: '.$post['id'].' thành công'
        ]);
    }

    
}
