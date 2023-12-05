<?php

namespace App\Repositories;

use App\Models\Ward;
use App\Repositories\Interfaces\WardRepositoryInterface;

class WardRepository extends BaseRepository implements WardRepositoryInterface
{
    protected $model;
    
    public function __construct(Ward $model)
    {
        $this->model = $model;
    }

    public function findWardByDistrictId($district_id)
    {
        return $this->model->where('district_code', '=', $district_id)->get();
    }
}
