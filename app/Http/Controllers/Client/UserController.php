<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $courseRepository;
    protected $subjectRepository;
    protected $taskRepository;
    protected $userRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository, TaskRepositoryInterface $taskRepository,
        CourseRepositoryInterface $courseRepository,
        UserRepositoryInterface $userRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->subjectRepository = $subjectRepository;
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }

    public function show($id)
    {
        $user = $this->userRepository->find($id);
        $courses = $user->courses;
        $subjects = $user->subjects;
        $tasks = $user->tasks;

        return view('client.user.profile', compact('user', 'courses', 'subjects', 'tasks'));
    }

    public function update(ClientRequest $request, $id)
    {
        $validator = $request->validated();
        if (is_object($validator)) {
            return response()->json([
                'error' => true,
                'messages' => $validator->errors(),
            ], config('client.user.fail'));
        }
        try {
            $attr = [
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'avatar' => $request->get('avatar'),
            ];
            $user = $this->userRepository->update($id, $attr);

            return response()->json(['user' => $user], config('client.user.network'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
