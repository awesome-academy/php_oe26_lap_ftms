<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Enums\StatusUserCourse;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Notifications\NotificationUser;
use DB;

class UserController extends Controller
{
    private $userRepository;
    private $categoryRepository;
    private $courseRepository;
    private $subjectRepository;
    private $taskRepository;

    public function __construct (
        UserRepositoryInterface  $userRepository,
        CategoryRepositoryInterface  $categoryRepository,
        CourseRepositoryInterface  $courseRepository,
        SubjectRepositoryInterface  $subjectRepository,
        TaskRepositoryInterface  $taskRepository)
    {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->courseRepository = $courseRepository;
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
        $users = $this->userRepository->getPaginate();
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password = $request->password;
        $repassword = $request->repassword;
        if ($password == $repassword) {
            if ($request->hasFile('avatar')) {  
                $avatar = $this->uploadAvatar($request);
            } else {
                $avatar = config('configuser.avatar_default');
            }
            $attributes = $request->only([
                'name',
                'email',
                'phone',
                'address',
                'role_id',
            ]);
            $attributes['avatar'] = $avatar;
            $attributes['password'] = bcrypt($request->get('password'));
            $this->userRepository->create($attributes);

            return redirect()->route('admin.users.index')->with('alert', trans('setting.add_user_success'));    
        } else {
            return redirect()->route('admin.users.create')->with('alert', trans('setting.checkpassoword'));
        }
    }

    public function uploadAvatar(UserRequest $request)
    {
        $destinationDir = public_path(config('configuser.public_path'));
        $fileName = uniqid('avatar') . '.' . $request->avatar->extension();
        $request->avatar->move($destinationDir, $fileName);
        $avatar = config('configuser.avatar') . $fileName;

        return $avatar;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $userDetail = $this->userRepository->find($id);
            $courses = $this->courseRepository->getAll();
            $subjects = $this->subjectRepository->getAll();
            $tasks = $this->taskRepository->getAll();
            $userCourse = $userDetail->courses;
            $userCourseDetail = $this->userRepository->getUserCourseDetail($id);
            $userSubject = $userDetail->subjects;
            $userSubjectDetail = $this->userRepository->getUserSubjectDetail($id);
            $userTask = $userDetail->tasks;
            $userTaskDetail = $this->userRepository->getUserTaskDetail($id);

            return view('admin.users.show', compact('userDetail', 'courses', 'userCourse', 'userCourseDetail', 
                'userSubject', 'userSubjectDetail','userTask','userTaskDetail', 'subjects', 'tasks'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function exportSubject($id)
    {
        $listSubject = $this->userRepository->getCourseSubjectByCourse($id);
        
        return response()->json(['listSubject' => $listSubject], config('configuser.json'));
    }

    public function finishCourse(Request $request, $id)
    {        
        $courseSubject = $this->courseRepository->find($request->course_id)->subjects;
        $count = config('configuser.count');
        foreach ($courseSubject as $value) {
            $check = $this->userRepository->getCheckUserSubject($id, $value->id);
            if (count($check) >= config('configuser.check')) {
                $count++;
            }
        }
        if ($count == count($courseSubject)) {
            $this->userRepository->updateStatusUserCourseFinished($request->course_id, $id);
            
            return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.finish_course_success'));
        } else {
            return redirect()->route('admin.users.show', $id)->with('error', trans('setting.error_course_fail'));
        }
    }

    public function finishSubject(Request $request, $id)
    {
        $this->userRepository->updateStatusUserSubject($request->subject_id, $id);
        $check = $this->userRepository->getUserCourseStatusActivity($id);
        foreach ($check as $value) {
            $process = $value->process;
            $course_id = $value->course_id;
        }
        $this->userRepository->updateProcessUserCourse($id, $course_id, $process);

        return redirect()->route('admin.users.show', $id);
    }

    public function finishTask(Request $request, $id)
    {
        try {
            $this->userRepository->updateStatusUserTaskFinished($request->task_id, $id);
            $subject = $this->taskRepository->find($request->task_id)->subject_id;
            $check = $this->userRepository->getUserSubject($subject_id, $id);
            foreach ($check as $check) {
                $process = $check->process;
            }
            $this->userRepository->updateProcessUserSubject($subject, $id, $process);
            
            return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_user_task_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function addUserCourse(Request $request, $id)
    {
        try {
            $user = $this->userRepository->find($id);
            $check = $this->userRepository->getUserCourse($request->course_id, $id);
            $checkStatusUser = $this->userRepository->getUserCourseStatusFinished($id);
            if (count($checkStatusUser) >= config('configuser.checkStatusUser')) {
                return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_status_user'));
            } else {
                if (count($check) >= config('configuser.check')) {
                    return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_user_course'));
                } else {
                    $user->courses()->attach($request->course_id);
                    $userSubject = $this->userRepository->getUserSubject($request->subject_id, $id);
                    if (count($userSubject) < config('configuser.userSubject')) {
                        $courseName = $this->courseRepository->find($request->course_id)->name;
                        $data = [
                            'name' => $courseName,
                            'course_id' => $request->course_id,
                        ];
                        $user->notify(new NotificationUser($data));
                        $subjectName = $this->subjectRepository->find($request->subject_id)->name;
                        $data = [
                            'name' => $subjectName,
                            'course_id' => $request->course_id,
                        ];
                        $user->notify(new NotificationUser($data));
                        $user->subjects()->attach($request->subject_id);

                        return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.check_user_subject'));
                    }

                    return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_success'));
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function addUserSubject(Request $request, $id)
    {
        try {
            $user = $this->userRepository->find($id);
            $check = $this->userRepository->getUserSubject($request->subject_id, $id);
            $checkStatusUser = $this->userRepository->getUserSubjectStatusActivity($user_id);
            $course_id = $this->subjectRepository->find($request->subject_id)->courses;
            $count = config('configuser.count');
            foreach ($course_id as $course) {
                $checkUserCourse = $this->userRepository->getUserCourse($course->id, $id);
                if (count($checkUserCourse) >= config('configuser.checkUserCourse')) {
                    $count++;
                }
            }
            if ($count >= config('configuser.count_check')) {
                if (count($checkStatusUser) >= config('configuser.checkStatusUser')) {
                    return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_status_user'));
                } else {
                    if (count($check) >= config('configuser.count_check')) {
                        return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_user_course'));
                    } else {
                        $user->subjects()->attach($request->subject_id);
                        
                        return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_success'));
                    }
                }
            } else {
                return redirect()->route('admin.users.show', $id)->with('error', trans('setting.assign_user_task_fail'));
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function addUserTask(Request $request, $id)
    {
        try {
            $user = $this->userRepository->find($id);
            $check = $this->userRepository->getUserTask($request->task_id, $id);
            $checkStatusUser = $this->userRepository->getUserTaskStatusActivity($id);
            $subject_id = $this->taskRepository->find($request->task_id)->subject_id;
            $checkUserSubject = $this->userRepository->getUserSubject($subject_id, $id);
            if (count($checkUserSubject) >= config('configuser.checkUserSubject')) {
                if (count($checkStatusUser) >= config('configuser.checkStatusUser')) {
                    return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_status_user'));
                } else {
                    if (count($check) >= config('configuser.count_check')) {
                        return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_user_course'));
                    } else {
                        $user->tasks()->attach($request->task_id);

                        return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_success'));
                    }
                }    
            } else {
                return redirect()->route('admin.users.show', $id)->with('error', trans('setting.assign_user_task_fail'));
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function deleteUserCourse(Request $request, $id)
    {
        try {
            $course = $this->courseRepository->find($id);
            $course->users()->detach($request->user_id);

            return redirect()->route('admin.users.show', $request->user_id)->with('alert', trans('setting.delete_user_course_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function deleteUserSubject(Request $request, $id)
    {
        try {
            $subject = $this->subjectRepository->find($id);
            $user = $this->userRepository->find($request->user_id);
            $tasks = $subject->tasks;
            $user->tasks()->detach($tasks);
            $subject->users()->detach($request->user_id);

            return redirect()->route('admin.users.show', $request->user_id)->with('alert', trans('setting.delete_user_subject_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function deleteUserTask(Request $request, $id)
    {
        try {
            $task = $this->taskRepository->find($id);
            $task->users()->detach($request->user_id);

            return redirect()->route('admin.users.show', $request->user_id)->with('alert', trans('setting.delete_user_task_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $user = $this->userRepository->find($id);

            return view('admin.users.edit', compact('user'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $password = $request->password;
            $repassword = $request->repassword;
            if ($password == $repassword) {
                $user = $this->userRepository->find($id);
                if ($request->hasFile('avatar')) {  
                    $avatar = $this->uploadAvatar($request);
                } else {
                    $avatar = $user->avatar;
                }
                $attributes = $request->only([
                    'name',
                    'email',
                    'phone',
                    'address',
                    'role_id',
                ]);
                $attributes['avatar'] = $avatar;
                $attributes['password'] = bcrypt($request->get('password'));
                $this->userRepository->update($id, $attributes);

                return redirect()->route('admin.users.index')->with('alert', trans('setting.edit_user_success'));    
            } else {
                return redirect()->route('admin.users.edit', $user->id)->with('alert', trans('setting.checkpassoword'));
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->userRepositoty->delete($id);

            return redirect()->route('admin.users.index')->with('alert', trans('setting.delete_user_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
