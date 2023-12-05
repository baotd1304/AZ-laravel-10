<?php

namespace App\Repositories\Interfaces;

interface DistrictRepositoryInterface
{
    public function getAll();
    public function findDistrictByProvinceId($province_id);
    
}
