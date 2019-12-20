<?php

namespace Tests\Unit\Controllers\Client;

use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Controllers\Client\CourseController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Course;
use Tests\TestCase;
use Mockery;

class CourseControllerTest extends TestCase
{

    protected $courseRepository;
    protected $categoryRepository;

    public function setUp(): void
    {
        $this->courseRepository = Mockery::mock(CourseRepositoryInterface::class);
        $this->categoryRepository = Mockery::mock(CategoryRepositoryInterface::class);
        parent::setUp();
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $controller =  new CourseController($this->courseRepository, $this->categoryRepository);
        $this->courseRepository->shouldReceive('getCourseByTime')->once()->andReturn(array());
        $this->categoryRepository->shouldReceive('getCategoryChildByName')->once()->andReturn(array());
        $view = $controller->index();

        $this->assertEquals('client.course.index', $view->getName());
        $this->assertArrayHasKey('categories', $view->getData());
        $this->assertArrayHasKey('courses', $view->getData());
    }

    public function testShow()
    {
        $controller = new CourseController($this->courseRepository, $this->categoryRepository);
        $this->courseRepository->shouldReceive('find')->with(config('test.course'))->once()->andReturn(new Course());
        $view = $controller->show(config('test.course'));

        $this->assertEquals('client.course.course', $view->getName());
        $this->assertArrayHasKey('course', $view->getData());
    }

    public function testHistory()
    {
        $controller =  new CourseController($this->courseRepository, $this->categoryRepository);
        $this->courseRepository->shouldReceive('getSubjectByCourse')->with(config('test.course'))->once()->andReturn(array());
        $view = $controller->history(config('test.course'));

        $this->assertEquals('client.history.subjects', $view->getName());
        $this->assertArrayHasKey('subjects', $view->getData());
    }
}
