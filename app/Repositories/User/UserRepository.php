<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use App\Models\User;
use App\Enums\StatusUserCourse;
use DB;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getUserByRole($role)
    {
        return User::where('role_id', 1)->get();
    }

    public function findWithCourse($id)
    {
        return User::with('courses')->find($id);
    }

    public function findWithTask($id)
    {
        return User::with('tasks')->find($id);
    }

    public function getUserCourseDetail($id)
    {
        return DB::table('user_course')
            ->where('user_id', $id)
            ->get();
    }

    public function getUserSubjectDetail($id)
    {
        return DB::table('user_subject')
            ->where('user_id', $id)
            ->get();
    }

    public function getUserTaskDetail($id)
    {
        return DB::table('user_task')
            ->where('user_id', $id)
            ->get();
    }

    public function getCourseSubjectByCourse($id)
    {
        return DB::table('course_subject')
            ->where('course_id', $id)
            ->get();
    }

    public function getCheckUserSubject($user_id, $subject_id)
    {
        return DB::table('user_subject')
            ->where('user_id', $user_id)
            ->where('subject_id', $subject_id)
            ->where('status', StatusUserCourse::Finished)
            ->get();
    }

    public function updateStatusUserCourseFinished($course_id, $user_id)
    {
        return DB::table('user_course')
            ->where('course_id', $course_id)
            ->where('user_id', $user_id)
            ->update(['status' => StatusUserCourse::Finished, 'updated_at' => now()]);
    }

    public function updateStatusUserSubject($subject_id, $user_id)
    {
        return DB::table('user_subject')
            ->where('subject_id', $subject_id)
            ->where('user_id', $user_id)
            ->update(['status' => StatusUserCourse::Finished, 'updated_at' => now()]);
    }

    public function getUserCourseStatusActivity($user_id)
    {
        return DB::table('user_course')
            ->where('user_id', $user_id)
            ->where('status', StatusUserCourse::Activity)
            ->get();
    }

    public function updateProcessUserCourse($user_id, $course_id, $process)
    {
        return DB::table('user_course')
            ->where('user_id', $user_id)
            ->where('course_id', $course_id)
            ->update(['process' => ++$process]);
    }

    public function updateStatusUserTaskFinished($task_id, $user_id)
    {
        return DB::table('user_task')
            ->where('task_id', $task_id)
            ->where('user_id', $user_id)
            ->update(['status' => StatusUserCourse::Finished, 'updated_at' => now()]);
    }

    public function getUserSubject($subject_id, $user_id)
    {
        return DB::table('user_subject')
            ->where('subject_id', $subject_id)
            ->where('user_id', $user_id)
            ->get();
    }

    public function updateProcessUserSubject($subject_id, $user_id, $process)
    {
        return DB::table('user_subject')
            ->where('subject_id', $subject_id)
            ->where('user_id', $user_id)
            ->update(['process' => ++$process]);
    }

    public function getUserCourse($course_id, $user_id)
    {
        return DB::table('user_course')
            ->where('course_id', $course_id)
            ->where('user_id', $user_id)
            ->get();
    }

    public function getUserCourseStatusFinished($user_id)
    {
        return DB::table('user_course')
            ->where('user_id', $user_id)
            ->where('status', StatusUserCourse::Finished)
            ->get();
    }

    public function getUserSubjectStatusActivity($user_id)
    {
        return DB::table('user_subject')
            ->where('user_id', $id)
            ->where('status', StatusUserCourse::Activity)
            ->get();
    }

    public function getUserTask($task_id, $user_id)
    {
        return DB::table('user_task')
            ->where('task_id', $task_id)
            ->where('user_id', $user_id)
            ->get();
    }

    public function getUserTaskStatusActivity($user_id)
    {
        return DB::table('user_task')
            ->where('user_id', $user_id)
            ->where('status', StatusUserCourse::Activity)
            ->get();
    }
}

