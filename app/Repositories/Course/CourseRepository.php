<?php

namespace App\Repositories\Course;

use App\Repositories\EloquentRepository;
use App\Models\Course;

class CourseRepository extends EloquentRepository implements CourseRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }

    public function getCourseByTime()
    {
        return Course::latest('created_at');
    }
}
