<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllPaginate()
    {
        return $this->user->paginate(15);
    }
}
