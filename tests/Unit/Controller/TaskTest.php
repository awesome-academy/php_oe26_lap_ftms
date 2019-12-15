<?php

namespace Tests\Unit\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;
use App\Http\Controllers\Admin\TaskController;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\RedirectResponse;

class TaskTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    private $taskRepository;
    private $subjectRepository;
    private $userRepository;
    private $taskRequest;


    public function setUp() : void
    {
        parent::setup();
        $this->taskRepository = Mockery::mock(TaskRepositoryInterface::class);
        $this->subjectRepository = Mockery::mock(SubjectRepositoryInterface::class);
        $this->userRepository = Mockery::mock(UserRepositoryInterface::class);
        $this->taskRequest = Mockery::mock(TaskRequest::class);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testIndex()
    {
        $controller = new TaskController($this->taskRepository, $this->subjectRepository, $this->userRepository);

        $this->taskRepository->shouldReceive('getPaginate')->once()->andReturn(array());
        $view = $controller->index();

        $this->assertEquals('admin.tasks.index', $view->getName());
        $this->assertArrayHasKey('tasks', $view->getData());
    }

    public function testCreate()
    {
        $controller = new TaskController($this->taskRepository, $this->subjectRepository, $this->userRepository);

        $this->subjectRepository->shouldReceive('getAll')->once()->andReturn(array());
        $view = $controller->create();

        $this->assertEquals('admin.tasks.create', $view->getName());
        $this->assertArrayHasKey('subjects', $view->getData());
    }

    public function testStore()
    {
        $controller = new TaskController($this->taskRepository, $this->subjectRepository, $this->userRepository);

        $this->taskRequest->shouldReceive('all')->once()->andReturn(array());
        $this->taskRepository->shouldReceive('create')->once()->andReturn(new Task());
        $this->taskRequest->shouldReceive('get')->once()->andReturn(array());

        $response = $controller->store($this->taskRequest);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.tasks.index'), $response->headers->get('location'));
    }

    public function testShow()
    {
        $id = config('configtest.id');
        $controller = new TaskController($this->taskRepository, $this->subjectRepository, $this->userRepository);

        $this->taskRepository->shouldReceive('find')->once()->andReturn($id);
        $this->taskRepository->shouldReceive('findUserByTask')->once()->andReturn(array());
        $this->userRepository->shouldReceive('getAll')->once()->andReturn(array());
        $view = $controller->show($id);

        $this->assertEquals('admin.tasks.show', $view->getName());
        $this->assertArrayHasKey('task', $view->getData());
        $this->assertArrayHasKey('userTask', $view->getData());
        $this->assertArrayHasKey('listUsers', $view->getData());
        $this->assertArrayHasKey('statusUser', $view->getData());
    }

    public function testEdit()
    {
        $id = config('configtest.id');
        $controller = new TaskController($this->taskRepository, $this->subjectRepository, $this->userRepository);

        $this->taskRepository->shouldReceive('find')->once()->andReturn(new Task());
        $this->subjectRepository->shouldReceive('getAll')->once()->andReturn(array());
        $view = $controller->edit($id);

        $this->assertEquals('admin.tasks.edit', $view->getName());
        $this->assertArrayHasKey('subjects', $view->getData());
        $this->assertArrayHasKey('task', $view->getData());
    }

    public function testUpdate()
    {
        $id = config('configtest.id');
        $controller = new TaskController($this->taskRepository, $this->subjectRepository, $this->userRepository);
        $this->taskRequest->shouldReceive('all')->once()->andReturn(array());
        $this->taskRequest->shouldReceive('get')->once()->andReturn(array());
        $this->taskRepository->shouldReceive('update')->once()->andReturn(new Task());

        $response = $controller->update($this->taskRequest, $id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.tasks.index'), $response->headers->get('location'));
    }

    public function testDelete()
    {   
        $id = config('configtest.id');
        $controller = new TaskController($this->taskRepository, $this->subjectRepository, $this->userRepository);
        $this->taskRepository->shouldReceive('delete')->once()->andReturn();

        $response = $controller->destroy($id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.tasks.index', $response->headers->get('location')));
    }
}
