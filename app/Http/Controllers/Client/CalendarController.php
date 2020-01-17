<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class CalendarController extends Controller
{
    protected $subjectRepository;
    protected $userRepository;

    public function __construct(
        SubjectRepositoryInterface $subjectRepository,
        UserRepositoryInterface $userRepository)
    {
        $this->subjectRepository = $subjectRepository;
        $this->userRepository = $userRepository;
    }

    public function show()
    {
        $user_id = Auth::user()->id;
        $user = $this->userRepository->find($user_id);
        $subjectCalendar = array();
        foreach ($user->subjects as $subject) {
            if ($subject->pivot->status == config('client.status.done')) {
                $subject1['created_at'] = $subject->pivot->created_at;
                $subject1['updated_at'] = $subject->pivot->updated_at;
                $subject1['name'] = $subject->name;
                $subject1['color'] = config('client.color.green');
            }
            else if ($subject->pivot->status == config('client.status.nodone')) {
                $subject1['created_at'] = $subject->pivot->created_at;
                $duration = strtotime($subject->pivot->created_at) + $subject->duration * config('client.hour');
                $subject1['updated_at'] = date('Y-m-d h:m:s', $duration);
                $subject1['name'] = $subject->name;
                $day = strtotime(date('Y-m-d'));
                if ($duration <= $day) {
                    $subject1['color'] = config('client.color.red');;
                } else {
                    $subject1['color'] = config('client.color.yellow');;
                }
            }
            $subjectCalendar[] = $subject1;
        }

        return view('client.calendar.index', compact('subjectCalendar'));
    }
}
