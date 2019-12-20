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
        return Course::latest('created_at')->paginate(config('course.PagePaginate'));
    }

    public function getSubjectByCourse($id)
    {
        return Course::find($id)->subjects()->paginate(config('course.PagePaginate'));
    }

    public function getCourseByCategory($arr)
    {
        return Course::whereIn('category_id', $arr)->paginate(config('course.PagePaginate'));
    }
}
