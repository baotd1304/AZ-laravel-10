<?php

namespace App\Repositories\Interfaces;

interface WardRepositoryInterface
{
    public function getAll();
    public function findWardByDistrictId($district_id);
}
