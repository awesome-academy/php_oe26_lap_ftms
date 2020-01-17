<?php

namespace App\Http\Controllers\Client;

use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ReportController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(Request $request)
    {
        $user_id = Auth::User()->id;
        $task_id = $request->get('task_id');
        $user = $this->userRepository->find($user_id);
        $user->tasks()->attach($task_id, [
            'status' => config('client.status.nodone'),
            'created_at' => now(),
            'updated_at' => now(),
            'report' => $request->get('report'),
        ]);

        return response()->json('OK', config('client.user.network'));
    }

    public function show(Request $request)
    {
        $user_id = Auth::user()->id;
        $task_id = $request->task_id;
        $user = $this->userRepository->findWithTask($user_id);
        foreach ($user->tasks as $task) {
            if ($task->id == $task_id) {
                $result = $task->pivot->report;
            }
        }

        return response()->json(['result' => $result], config('client.user.network'));
    }
}
