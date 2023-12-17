<?php

namespace App\Services\Interfaces;

/**
 * Interface PostCatalogueServiceInterface
 * @package App\Services\Interfaces
 */
interface PostCatalogueServiceInterface
{
    public function pagination($request);
    public function create($request);
    public function update($id, $request);
    public function updateStatus($id, $post=[]);
    public function delete($id);
}
