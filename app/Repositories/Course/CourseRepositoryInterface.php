<?php

namespace App\Repositories\Course;

interface CourseRepositoryInterface
{
    public function getCourseByTime();

    public function getSubjectByCourse($id);

    public function getCourseByCategory($arr);
}
