<?php

namespace App\Services\Interfaces;

/**
 * Interface PostServiceInterface
 * @package App\Services\Interfaces
 */
interface PostServiceInterface
{
    public function pagination($request);
    public function create($request);
    public function update($id, $request);
    public function updateStatus($id, $post=[]);
    public function delete($id);
}
