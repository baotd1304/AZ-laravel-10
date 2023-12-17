<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
        $users = $this->userRepository->pagination(
            $column, 
            $condition,
            [], //join
            ['path' => route('admin.users.index')],
            $perPage,
            ['userCatalogue']
        );
        return $users;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payLoad = $request->except(['_token', 'send', 'confirm_password']);
            $payLoad['birthday'] = $this->convertDate($payLoad['birthday']);
            $payLoad['password'] = Hash::make($request->password);
            $createUser = $this->userRepository->create($payLoad);
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
    public function edit($id)
    {
        return $this->userRepository->findById($id);
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payLoad = $request->except(['_token','send']);
            if (isset($payLoad['birthday'])){
                $payLoad['birthday'] = $this->convertDate($payLoad['birthday']);
            }
            $createUser = $this->userRepository->update($id, $payLoad);
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
            $updateStatus = $this->userRepository->update($id, $payLoad);
            
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
            $updateStatusAll = $this->userRepository->updateByWhereIn($column, $post['id'], $payLoad);
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
            $updateStatus = $this->userRepository->update($post['id'], $payLoad);
            
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
            $deleteUser = $this->userRepository->delete($id);
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
            $deleteUser = $this->userRepository->deleteChecked($id);
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
