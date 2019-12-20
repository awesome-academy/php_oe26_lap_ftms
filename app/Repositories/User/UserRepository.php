<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use App\Models\User;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function getModel() {
        return User::class;
    }
}
