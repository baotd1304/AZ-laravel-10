<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function getAll();
    public function findById($modelId, $column=[], $relation=[]);
    public function create($payLoad);
    public function update($id, $payLoad);
    public function updateByWhereIn($whereInField = '', $whereIn= [], $payLoad=[]);
    public function delete($id);
    public function deleteChecked($id=[]);
    public function pagination(
        $column=['*'], $condition=[], 
        $join=[], $extend=[], $perPage,
    );

}
