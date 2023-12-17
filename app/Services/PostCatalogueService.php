<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Class PostCatalogueService
 * @package App\Services
 */
class PostCatalogueService implements PostCatalogueServiceInterface
{
    protected $postCatalogueRepository;
    protected $postService;

    public function __construct(
        PostCatalogueRepository $postCatalogueRepository,
        PostService $postService
    )
    {
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->postService = $postService;
    }

    public function pagination($request)
    {
        $condition['keyword'] = $request->input('keyword');
        $condition['publish'] = $request->input('publish');
        if (isset($condition['keyword'])){
            $condition['keyword'] = addslashes($request->input('keyword'));
        }
        $perPage = $request->integer('per_page');
        $column = $this->paginateSelect();
        $relation = ['author', 'posts', 'languages'];
        $postCatalogues = $this->postCatalogueRepository->pagination(
            $column, 
            $condition, 
            [], //join
            ['path' => route('admin.post_catalogues.index')],
            $perPage,
            $relation
        );
        return $postCatalogues;
    }

    public function getAll()
    {
        return $this->postCatalogueRepository->getAll();
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payLoad = $request->except(['_token', 'send']);
            $createUserCatalogue = $this->postCatalogueRepository->create($payLoad);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payLoad = $request->except(['_token','send']);
            $updateUserCatalogue = $this->postCatalogueRepository->update($id, $payLoad);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function updateStatus($id, $post=[])
    {
        DB::beginTransaction();
        try {
            $id = $post['id'];
            $payLoad[$post['field']] = (($post['value'] == 1)? 2 : 1);
            // dd($post);
            $updateStatus = $this->postCatalogueRepository->update($id, $payLoad);
            
            $this->updateStatusPostDependPostCatalogue($post);
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }
    private function updateStatusPostDependPostCatalogue($post)
    {
        $post['column'] = 'post_catalogue_id';
        if (!is_array($post['id'])) {
            $post['id'] = str_split($post['id']);
            $post['value'] = (($post['value'] == 1)? 2 : 1);
        }
        return $this->postService->updateStatusAll($post);
    }

    public function updateStatusAll($post=[])
    {
        DB::beginTransaction();
        try {
            $payLoad[$post['field']] = $post['value'];
            // dd($post);
            $updateStatusAll = $this->postCatalogueRepository->updateByWhereIn('id', $post['id'], $payLoad);
            $this->updateStatusPostDependPostCatalogue($post);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }
    

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $deleteUser = $this->postCatalogueRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function deleteChecked($id=[])
    {
        DB::beginTransaction();
        try {
            // dd($id);
            $deleteUser = $this->postCatalogueRepository->deleteChecked($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }


    private function paginateSelect()
    {
        return ['id', 'user_id', 'level', 'image', 'publish', 'order'];
    }

    

}
