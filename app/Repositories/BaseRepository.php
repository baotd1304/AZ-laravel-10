<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    public function getAll()
    {
        return $this->model->all();
    }
    public function pagination(
        $column=['*'], $condition=[], 
        $join=[], $extend=[], $perPage=0
    ){
        $query = $this->model->select($column)->where(function($que) use ($condition, $column){
            if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                if (isset($column)){
                    foreach ($column as $key => $field){ //lap qua cac field da chon tu ham` paginateSelect o UserService
                        $que->orWhere($field, 'LIKE', '%'.$condition['keyword'].'%');
                    };
                }
            };
        });
        if (!empty($join)){
            $query->join(...$join);
        }
        return $query->paginate($perPage)
                    ->withQueryString()->withPath($extend['path']);
    }
    
    public function findById($modelId, $column=['*'], $relation=[]){
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }
    
    public function create($payLoad=[])
    {
        return $this->model->create($payLoad);
    }
    public function update($id=0, $payLoad=[])
    {
        return $this->findById($id)->update($payLoad);
    }
    public function delete($id)
    {
        return $this->findById($id)->delete();
    }
}
