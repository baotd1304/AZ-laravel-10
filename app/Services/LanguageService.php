<?php

namespace App\Services;

use App\Services\Interfaces\LanguageServiceInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Class LanguageService
 * @package App\Services
 */
class LanguageService implements LanguageServiceInterface
{
    protected $languageRepository;

    public function __construct(
        LanguageRepository $languageRepository,
    )
    {
        $this->languageRepository = $languageRepository;
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
        $languages = $this->languageRepository->pagination(
            $column, 
            $condition, 
            [], //join
            ['path' => route('admin.languages.index')],
            $perPage,
        );
        return $languages;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payLoad = $request->except(['_token', 'send']);
            $createUserCatalogue = $this->languageRepository->create($payLoad);
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
        return $this->languageRepository->findById($id);
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payLoad = $request->except(['_token','send']);
            $updateUserCatalogue = $this->languageRepository->update($id, $payLoad);
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
            $updateStatus = $this->languageRepository->update($id, $payLoad);
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function updateStatusAll($post=[])
    {
        DB::beginTransaction();
        try {
            $payLoad[$post['field']] = $post['value'];
            // dd($post);
            $updateStatusAll = $this->languageRepository->updateByWhereIn('id', $post['id'], $payLoad);

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
            $deleteUser = $this->languageRepository->delete($id);
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
            $deleteUser = $this->languageRepository->deleteChecked($id);
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
        return [
            'id',
            'name',
            'canonical',
            'image',
            'publish'
        ];
    }

    

}
