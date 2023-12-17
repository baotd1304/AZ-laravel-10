<?php

namespace App\Services;

use App\Services\Interfaces\PostServiceInterface;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Class PostService
 * @package App\Services
 */
class PostService implements PostServiceInterface
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function pagination($request)
    {
        $condition['keyword'] = $request->input('keyword');
        $condition['publish'] = $request->input('publish');
        $condition['user_catalogue_id'] = $request->input('user_catalogue_id');
        if (isset($condition['keyword'])){
            $condition['keyword'] = addslashes($request->input('keyword'));
        }
        $perPage = $request->integer('per_page');
        $column = $this->paginateSelect();
        // dd($condition);
        $users = $this->postRepository->pagination(
            $column, 
            $condition,
            [], //join
            ['path' => route('admin.posts.index')],
            $perPage,
        );
        // dd($users->name);
        return $users;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payLoad = $request->except(['_token', 'send', 'confirm_password']);
            $payLoad['birthday'] = $this->convertDate($payLoad['birthday']);
            $payLoad['password'] = Hash::make($request->password);
            $createUser = $this->postRepository->create($payLoad);
            // dd($createUser);
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
            if (isset($payLoad['birthday'])){
                $payLoad['birthday'] = $this->convertDate($payLoad['birthday']);
            }
            $createUser = $this->postRepository->update($id, $payLoad);
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
            // dd($payLoad);
            $updateStatus = $this->postRepository->update($id, $payLoad);
            
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
            $column = $post['column'];
            $payLoad[$post['field']] = $post['value'];
            $updateStatusAll = $this->postRepository->updateByWhereIn($column, $post['id'], $payLoad);
            // dd($updateStatusAll);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function changeFieldSelect($post=[])
    {
        DB::beginTransaction();
        try {
            $payLoad[$post['field']] = $post['value'];
            $updateStatus = $this->postRepository->update($post['id'], $payLoad);
            
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
            $deleteUser = $this->postRepository->delete($id);
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
            $deleteUser = $this->postRepository->deleteChecked($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    private function convertDate($date='')
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $date);
        $date = $carbonDate->format('Y-m-d H:i:s');
        return $date;
    }

    private function paginateSelect()
    {
        return ['id', 'email','name', 'phone', 'image', 'publish', 'user_catalogue_id'];
    }


}
