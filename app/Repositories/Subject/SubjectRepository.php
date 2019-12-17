<?php

namespace App\Repositories\Subject;

use App\Repositories\EloquentRepository;
use App\Models\Subject;

class SubjectRepository extends EloquentRepository implements SubjectRepositoryInterface
{
    public function getModel()
    {
        return Subject::class;
    }
}
