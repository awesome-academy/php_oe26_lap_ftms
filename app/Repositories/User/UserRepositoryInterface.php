<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getUserByRole($role);

    public function findWithCourse($id);

    public function findWithTask($id);

    public function findWithCourse($id);

    public function getUserCourseDetail($id);

    public function getUserByRole($role);

    public function getUserSubjectDetail($id);

    public function getUserTaskDetail($id);

    public function getCourseSubjectByCourse($id);
    
    public function getCheckUserSubject($user_id, $subject_id);

    public function updateStatusUserCourseFinished($course_id, $user_id);

    public function updateStatusUserSubject($subject_id, $user_id);

    public function getUserCourseStatusActivity($user_id);

    public function updateProcessUserCourse($user_id, $course_id, $process);

    public function updateStatusUserTaskFinished($task_id, $user_id);

    public function getUserSubject($subject_id, $user_id);

    public function updateProcessUserSubject($subject_id, $user_id, $process);

    public function getUserCourse($course_id, $user_id);

    public function getUserCourseStatusFinished($user_id);

    public function getUserSubjectStatusActivity($user_id);

    public function getUserTask($task_id, $user_id);

    public function getUserTaskStatusActivity($user_id);
}
