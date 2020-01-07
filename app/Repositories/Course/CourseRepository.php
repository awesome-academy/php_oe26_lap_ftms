<?php

namespace App\Repositories\Course;

use App\Repositories\EloquentRepository;
use App\Models\Course;
use Carbon\Carbon;

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

    public function groupCourseByYear()
    {
        return Course::withTrashed()->get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('Y');
        });
    }

    public function groupCourseByMonth($year, $month)
    {
        return Course::withTrashed()->where('created_at', 'LIKE', $year . '-' . $month . '-' . '%')->count();
    }
}
