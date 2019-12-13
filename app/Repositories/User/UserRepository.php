<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use App\Models\User;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getUserByRole($role)
    {
        return User::where('role_id', 1)->get();
    }

    public function findWithCourse($id)
    {
        return User::with('courses')->find($id);
    }
}
