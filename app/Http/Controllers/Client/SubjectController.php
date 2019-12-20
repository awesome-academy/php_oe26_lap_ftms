<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class SubjectController extends Controller
{
    protected $subjectRepository;
    protected $taskRepository;
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository, SubjectRepositoryInterface $subjectRepository, TaskRepositoryInterface $taskRepository)
    {
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
        $this->taskRepository = $taskRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $course_id = $request->course_id;
        $user_id = Auth::user()->id;
        $user = $this->userRepository->find($user_id);
        foreach ($user->courses as $course) {
            if($course->pivot->course_id == $course_id) {
                $permiss = $course->pivot->status;
            }
        }
        $subject = $this->subjectRepository->find($id);
        $tasks = $subject->tasks;

        return view('client.subject.subject', compact('subject', 'tasks', 'permiss'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function history($id)
    {
        $tasks = $this->subjectRepository->getIdTaskBySubject($id);
        $tasksSubject = $this->taskRepository->getTaskById($tasks);
        $tasksHistory = collect();
        foreach ($tasksSubject as $task) {
            foreach ($task->users as $user) {
                if($user->id == Auth::User()->id) {
                    $task1['time'] = strtotime($user->pivot->created_at);
                    $task1['date'] = $user->pivot->created_at;
                    $task1['task_id'] = $user->pivot->task_id;
                    $task1['content'] = trans('layouts.Ustart') . $this->taskRepository->find($user->pivot->task_id)->name;
                    $tasksHistory->push($task1);
                    if($user->pivot->status == 1) {
                        $task2['time'] = strtotime($user->pivot->updated_at);
                        $task2['date'] = $user->pivot->updated_at;
                        $task2['task_id'] = $user->pivot->task_id;
                        $task2['content'] = trans('layouts.complete') . $this->taskRepository->find($user->pivot->task_id)->name;
                    } else {
                        if($user->pivot->created_at != $user->pivot->updated_at) {
                            $task2['time'] = strtotime($user->pivot->updated_at);
                            $task2['date'] = $user->pivot->updated_at;
                            $task2['task_id'] = $user->pivot->task_id;
                            $task2['content'] = trans('layouts.Usend') . $this->taskRepository->find($user->pivot->task_id)->name;
                        }
                    }
                    $tasksHistory->push($task2);
                }
            }
        }
        $tasksHistory = $tasksHistory->sortByDesc('time');

        return view('client.history.tasks', compact('tasksHistory'));
    }
}
