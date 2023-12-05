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
        // dd($post);
        if (class_exists($serviceInterfaceNamespace)){
            $serviceInstance = app($serviceInterfaceNamespace);
        };
        $result = $serviceInstance->updateStatus($post['id'], $post);
        return response()->json([
            'result' => $result,
            'message' => 'Cập nhật trạng thái thành công'
        ]);
    }

    
}
