<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function getAll();
    public function findById($modelId, $column=[], $relation=[]);
    public function create($payLoad);
    public function update($id, $payLoad);
    public function pagination(
        $column=['*'], $condition=[], 
        $join=[], $extend=[], $perPage
    );

}
