<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseRepository;
    protected $categoryRepository;

    public function __construct(CourseRepositoryInterface $courseRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $courses = $this->courseRepository->getCourseByTime();

        $categories = $this->categoryRepository->getParentCategory();

        return view('client.course.index', compact('courses', 'categories'));
    }

    public function show($id)
    {
        $course = $this->courseRepository->find($id);

        return view('client.course.course', compact('course'));
    }

    public function history($id)
    {
        $subjects = $this->courseRepository->getSubjectByCourse($id);

        return view('client.history.subjects', compact('subjects'));
    }
}
