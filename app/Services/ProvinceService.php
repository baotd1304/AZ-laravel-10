<?php

namespace App\Services;

use App\Services\Interfaces\ProvinceServiceInterface;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
/**
 * Class ProvinceService
 * @package App\Services
 */
class ProvinceService implements ProvinceServiceInterface
{
    protected $provinceRepository;

    public function __construct(ProvinceRepository $provinceRepository)
    {
        $this->provinceRepository = $provinceRepository;
    }
    public function getAll()
    {
        $provinces = $this->provinceRepository->all();
        return $provinces;
    }
}
