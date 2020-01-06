<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $courseRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, CourseRepositoryInterface $courseRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->courseRepository = $courseRepository;
    }

    public function show($id)
    {
        $category = $this->categoryRepository->getIdCategorySameKind($id);
        $courses = $this->courseRepository->getCourseByCategory($category);

        $categories = $this->categoryRepository->getParentCategory();

        return view('client.course.index', compact('courses', 'categories'));
    }
}
