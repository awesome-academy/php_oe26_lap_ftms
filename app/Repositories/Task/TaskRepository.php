<?php

namespace App\Repositories\Task;

use App\Repositories\EloquentRepository;
use App\Models\Task;

class TaskRepository extends EloquentRepository implements TaskRepositoryInterface
{
    public function getModel()
    {
        return Task::class;
    }
}
