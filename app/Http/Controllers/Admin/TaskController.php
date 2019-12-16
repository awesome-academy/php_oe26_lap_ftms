<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Subject;
use App\Models\User;
use App\Http\Requests\TaskRequest;
use DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tasks = Task::latest('id')->with('subject')->paginate(config('page_paginate'));

        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        
        return view('admin.tasks.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = new Task;
        $attr = [
            'subject_id' => $request->get('subject_id'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];
        $task->create($attr);

        return redirect()->route('admin.tasks.index')->with('alert', trans('setting.add_task_success'));
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
            $task = Task::findOrFail($id);
            $userTask = Task::find($id)->users()->get();
            $listUsers = User::all();
            $statusUser = DB::table('user_task')
                ->where('task_id', $id)
                ->get();
            
            return view('admin.tasks.show', compact('task', 'userTask', 'listUsers', 'statusUser', 'subjectTask'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function assignTraineeTask(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $check = DB::table('user_task')
                ->where('task_id', $id)
                ->where('user_id', $request->user_id)
                ->get();
            $checkStatusUser = DB::table('user_task')
                ->where('user_id', $request->user_id)
                ->where('status', config('configtask.status_user_activity'))
                ->get();
            $subject_id = Task::find($id)->subject_id;
            $checkUserSubject = DB::table('user_subject')
                ->where('user_id', $request->user_id)
                ->where('subject_id', $subject_id)
                ->get();
            if (count($checkUserSubject) >= config('configtask.check_user_subject')) {
                if (count($checkStatusUser) >= config('configtask.check_status_user')) {
                    return redirect()->route('admin.tasks.show', $task->id)->with('error', trans('setting.error_join_task'));
                } else {
                    if (count($check) >= config('configtask.check_user_task')) {
                        return redirect()->route('admin.tasks.show', $task->id)->with('error', trans('setting.error_task_exist'));
                    } else {
                        Task::find($id)->users()->attach($request->user_id);

                        return redirect()->route('admin.tasks.show', $task->id)->with('alert', trans('setting.alert_assign_task'));
                    }
                }    
            } else {
                return redirect()->route('admin.tasks.show', $task->id)->with('error', trans('setting.error_do_not_subject'));
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function finishTraineeTask(Request $request, $id)
    {
        DB::table('user_task')
            ->where('task_id', $id)
            ->where('user_id', $request->user_id)
            ->update(['status' => config('configtask.status_user_finished')]);
        $subject = Task::find($id)->subject_id;
        $check = DB::table('user_subject')
            ->where('subject_id', $subject)
            ->where('user_id', $request->user_id)
            ->get();
        foreach ($check as $check) {
            $process = $check->process;
        }
        DB::table('user_subject')
            ->where('subject_id', $subject)
            ->where('user_id', $request->user_id)
            ->update(['process' => ++$process]);
        
        return redirect()->route('admin.tasks.show', $id)->with('alert', trans('setting.finish_task_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $task = Task::findOrFail($id);
            $subjects = Subject::all();
            
            return view('admin.tasks.edit', compact('subjects', 'task'));
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
    public function update(TaskRequest $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $attr = [
                'subject_id' => $request->get('subject_id'),
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ];
            $task->update($attr);

            return redirect()->route('admin.tasks.index')->with('alert', trans('setting.edit_task_success'));
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
            $task = Task::findOrFail($id);
            $task->delete();

            return redirect()->route('admin.tasks.index')->with('alert', trans('setting.delete_task_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
