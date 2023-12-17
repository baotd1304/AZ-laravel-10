<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Class UserCatalogueService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;
    protected $userService;

    public function __construct(
        UserCatalogueRepository $userCatalogueRepository,
        UserService $userService
    )
    {
        $this->userCatalogueRepository = $userCatalogueRepository;
        $this->userService = $userService;
    }
    public function getAll()
    {
        return $this->userCatalogueRepository->getAll();
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
        $userCatalogues = $this->userCatalogueRepository->pagination(
            $column, 
            $condition, 
            [], //join
            ['path' => route('admin.user_catalogues.index')],
            $perPage,
            ['users']
        );
        return $userCatalogues;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payLoad = $request->except(['_token', 'send']);
            $createUserCatalogue = $this->userCatalogueRepository->create($payLoad);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function edit ($id)
    {
        return $this->userCatalogueRepository->findById($id);
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payLoad = $request->except(['_token','send']);
            $updateUserCatalogue = $this->userCatalogueRepository->update($id, $payLoad);
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
            $updateStatus = $this->userCatalogueRepository->update($id, $payLoad);
            
            $this->updateStatusUserDependUserCatalogue($post);
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }
    private function updateStatusUserDependUserCatalogue($post)
    {
        $post['column'] = 'user_catalogue_id';
        if (!is_array($post['id'])) {
            $post['id'] = str_split($post['id']);
            $post['value'] = (($post['value'] == 1)? 2 : 1);
        }
        return $this->userService->updateStatusAll($post);
    }

    public function updateStatusAll($post=[])
    {
        DB::beginTransaction();
        try {
            $payLoad[$post['field']] = $post['value'];
            // dd($post);
            $updateStatusAll = $this->userCatalogueRepository->updateByWhereIn('id', $post['id'], $payLoad);
            $this->updateStatusUserDependUserCatalogue($post);

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
            $deleteUser = $this->userCatalogueRepository->delete($id);
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
            $deleteUser = $this->userCatalogueRepository->deleteChecked($id);
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
        return ['id', 'name', 'image', 'publish'];
    }

    

}
