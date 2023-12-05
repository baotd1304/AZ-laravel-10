<?php

namespace App\Http\Controllers\ajax;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $districtRepository;
    protected $provinceRepository;
    
    public function __construct(
        DistrictRepository $districtRepository,
        ProvinceRepository $provinceRepository
    ){
        $this->districtRepository = $districtRepository;
        $this->provinceRepository = $provinceRepository;
    }
    public function getLocation(Request $request)
    {
        $input = $request -> input();
        $html ='';
        if ($input['target'] == 'districts'){
            $province = $this->provinceRepository->findById($input['data']['location_id'], ['code', 'name'], ['districts']);
            $html = $this->renderHtml($province->districts, '[Chọn quận/huyện]');
        } else if ($input['target'] == 'wards'){
            $district = $this->districtRepository->findById($input['data']['location_id'], ['code', 'name'], ['wards']);
            $html = $this->renderHtml($district->wards, '[Chọn phường/xã]');
        }
        $response = [
            'html' => $html,
        ];
        
        return response()->json($response);
    }
    public function renderHtml($districts, $default)
    {
        $html = '<option value="0">'.$default.' </option>';
        foreach ($districts as $district){
            $html .= '<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        return $html;
    }

    
}
