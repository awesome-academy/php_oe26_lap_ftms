@extends('admin.layouts.main')
@section('title', config('configuser.show_user'))
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">{{ trans('setting.dashboard') }}</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-user"></i>
                <span>@yield('title')</span>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <ul>
                                    <li><b>{{ trans('setting.id') }} :</b> {{ $userDetail->id }}</li>
                                    <li><b>{{ trans('setting.name') }} :</b> {{ $userDetail->name }}</li>
                                    <li><b>{{ trans('setting.email') }} :</b> {{ $userDetail->email }}</li>
                                    <li><b>{{ trans('setting.address') }} :</b> {{ $userDetail->address }}</li>
                                    <li><b>{{ trans('setting.phone') }} :</b> {{ $userDetail->phone }}</li>
                                    <li><b>{{ trans('setting.role') }} :</b>
                                        @if ($userDetail->role_id == false)
                                            {{ trans('setting.trainee') }}
                                        @else
                                            {{ trans('setting.supervisor') }}
                                        @endif
                                    </li>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">{{ trans('setting.assign') }}</button>
                                </ul>
                            </div>
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#courses">{{ trans('setting.courses') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#subjects">{{ trans('setting.subjects') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#tasks">{{ trans('setting.tasks') }}</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="courses" class="container tab-pane active"><br>
                                                    <h3>{{ trans('setting.courses') }}</h3>
                                                    <form action="{{ route('addUserCourse', $userDetail->id) }}" method="post">
                                                        @csrf
                                                        <label for="">{{ trans('setting.courses') }}</label>
                                                        <select name="course_id" id="course_id" class="form-control">
                                                            <option value="">{{ trans('setting.courses') }}</option>
                                                            @foreach ($courses as $course)
                                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="">{{ trans('setting.subjects') }}</label>
                                                        <select name="subject_id" id="subject_id" class="form-control">
                                                            <option value="">{{ trans('setting.subjects') }}</option>
                                                        </select>
                                                        <hr>
                                                        <input type="hidden" data-id="{{ $userDetail->id }}" value="{{ $userDetail->id }}">
                                                        <button type="submit" class="btn btn-primary">{{ trans('setting.add') }}</button>
                                                    </form>
                                                </div>
                                                <div id="subjects" class="container tab-pane fade"><br>
                                                    <h3>{{ trans('setting.subjects') }}</h3>
                                                    <form action="{{ route('addUserSubject', $userDetail->id) }}" method="post">
                                                        @csrf
                                                        <select name="subject_id" id="" class="form-control">
                                                            @foreach ($subjects as $subject)
                                                                <option value="{{ $subject->id }}">{{ $subject->name }} </option>
                                                            @endforeach
                                                        </select>
                                                        <hr>
                                                        <button type="submit" class="btn btn-primary">{{ trans('setting.add') }}</button>
                                                    </form>
                                                </div>
                                                <div id="tasks" class="container tab-pane fade"><br>
                                                    <h3>{{ trans('setting.tasks') }}</h3>
                                                    <form action="{{ route('addUserTask', $userDetail->id) }}" method="post">
                                                        @csrf
                                                        <select name="task_id" id="" class="form-control">
                                                            @foreach ($tasks as $task)
                                                                <option value="{{ $task->id }}">{{ $task->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <hr>
                                                        <button type="submit" class="btn btn-primary">{{ trans('setting.add') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (session('alert'))
                                <div class="alert alert-success">{{ session('alert') }} </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }} </div>
                            @endif
                            <div class="modal-body">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tblcourses">{{ trans('setting.courses') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tblsubjects">{{ trans('setting.subjects') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tbltasks">{{ trans('setting.tasks') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tblcourses" class="container tab-pane active"><br>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th>{{ trans('setting.id') }}</th>
                                                    <th>{{ trans('setting.name') }}</th>
                                                    <th>{{ trans('setting.status') }}</th>
                                                    <th>{{ trans('setting.process') }}</th>
                                                    <th>{{ trans('setting.create_at') }}</th>
                                                    <th>{{ trans('setting.update_at') }}</th>
                                                    <th>{{ trans('setting.finish') }}</th>
                                                    <th>{{ trans('setting.delete') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($userCourse as $course)
                                                    <tr>
                                                        <td>{{ $course->id }}</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p><b>{{ $course->name }}</b></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @foreach ($userCourseDetail as $user)
                                                                @if ($user->course_id == $course->id)
                                                                    @if ($user->status == config('configuser.status_activity'))
                                                                        <button class="btn btn-warning">{{ trans('setting.activity') }}</button>
                                                                    @else
                                                                        <button class="btn btn-success">{{ trans('setting.success') }}</button>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($userCourseDetail as $user)
                                                                @if ($user->course_id == $course->id)
                                                                    {{ $user->process }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($userCourseDetail as $user)
                                                                @if ($user->course_id == $course->id)
                                                                    {{ $user->created_at }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($userCourseDetail as $user)
                                                                @if ($user->course_id == $course->id)
                                                                    {{ $user->updated_at }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <form id="finish-form" action="{{ route('finishCourse', $userDetail->id) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                @foreach ($userCourseDetail as $user)
                                                                    @if ($user->course_id == $course->id)
                                                                        @if ($user->status == config('configuser.status_activity'))
                                                                            <input class="d-none" type="hidden" name="course_id" value="{{ $user->course_id }}">
                                                                            <button type="submit" class="btn btn-info checkconfirm">
                                                                                {{ trans('setting.finish') }}
                                                                            </button>
                                                                        @else
                                                                            <button class="btn btn-success">{{ trans('setting.finished') }}</button>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('deleteUserCourse', $course->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="text" name="user_id" class="d-none" value="{{ $userDetail->id }}">
                                                                <button class="btn btn-danger" type="submit"><i class="fas fa-user-slash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="tblsubjects" class="container tab-pane fade"><br>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th>{{ trans('setting.id') }}</th>
                                                    <th>{{ trans('setting.name') }}</th>
                                                    <th>{{ trans('setting.status') }}</th>
                                                    <th>{{ trans('setting.process') }}</th>
                                                    <th>{{ trans('setting.create_at') }}</th>
                                                    <th>{{ trans('setting.update_at') }}</th>
                                                    <th>{{ trans('setting.finish') }}</th>
                                                    <th>{{ trans('setting.delete') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($userSubject as $subject)
                                                    <tr class="table-active">
                                                        <td>{{ $subject->id }}</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p><b>{{ $subject->name }}</b></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @foreach ($userSubjectDetail as $user)
                                                                @if ($user->subject_id == $subject->id)
                                                                    @if ($user->status == config('configuser.status_activity'))
                                                                        <button class="btn btn-warning">{{ trans('setting.activity') }}</button>
                                                                    @else
                                                                        <button class="btn btn-success">{{ trans('setting.success') }}</button>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($userSubjectDetail as $user)
                                                                @if ($user->subject_id == $subject->id)
                                                                    {{ $user->process }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($userSubjectDetail as $user)
                                                                @if ($user->subject_id == $subject->id)
                                                                    {{ $user->created_at }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($userSubjectDetail as $user)
                                                                @if ($user->subject_id == $subject->id)
                                                                    {{ $user->updated_at }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <form id="finish-form" action="{{ route('finishSubject', $userDetail->id) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                @foreach ($userSubjectDetail as $user)
                                                                    @if ($user->subject_id == $subject->id)
                                                                        @if ($user->status == config('configuser.status_activity'))
                                                                            <input class="d-none" type="hidden" name="subject_id" value="{{ $user->subject_id }}">
                                                                            <button type="submit" class="btn btn-info">{{ trans('setting.finish') }}</button>
                                                                        @else
                                                                            <button class="btn btn-success">{{ trans('setting.finished') }}</button>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('deleteUserSubject', $subject->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="text" name="user_id" class="d-none" value="{{ $userDetail->id }}">
                                                                <button class="btn btn-danger" type="submit"><i class="fas fa-user-slash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="tbltasks" class="container tab-pane fade"><br>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th>{{ trans('setting.id') }}</th>
                                                    <th>{{ trans('setting.name') }}</th>
                                                    <th>{{ trans('setting.status') }}</th>
                                                    <th>{{ trans('setting.process') }}</th>
                                                    <th>{{ trans('setting.create_at') }}</th>
                                                    <th>{{ trans('setting.update_at') }}</th>
                                                    <th>{{ trans('setting.finish') }}</th>
                                                    <th>{{ trans('setting.delete') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($userTask as $task)
                                                    <tr class="table table-info">
                                                        <td>{{ $task->id }}</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p><b>{{ $task->name }}</b></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @foreach ($userTaskDetail as $user)
                                                                @if ($user->task_id == $task->id)
                                                                    @if ($user->status == config('configuser.status_user'))
                                                                        <button class="btn btn-warning">{{ trans('setting.activity') }}</button>
                                                                    @else
                                                                        <button class="btn btn-success">{{ trans('setting.success') }}</button>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            @foreach ($userTaskDetail as $user)
                                                                @if ($user->task_id == $task->id)
                                                                    {{ $user->created_at }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($userTaskDetail as $user)
                                                                @if ($user->task_id == $task->id)
                                                                    {{ $user->updated_at }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <form id="finish-form" action="{{ route('finishTask', $userDetail->id) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                @foreach ($userTaskDetail as $user)
                                                                    @if ($user->task_id == $task->id)
                                                                        @if ($user->status == config('configuser.status_activity'))
                                                                            <input class="d-none" type="hidden" name="task_id" value="{{ $user->task_id }}">
                                                                            <button type="submit" class="btn btn-info checkconfirm">
                                                                                {{ trans('setting.finish') }}
                                                                            </button>
                                                                        @else
                                                                            <button class="btn btn-success">{{ trans('setting.finished') }}</button>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('deleteUserTask', $task->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="text" name="user_id" class="d-none" value="{{ $userDetail->id }}">
                                                                <button class="btn btn-danger" type="submit"><i class="fas fa-user-slash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</div>
</div>
@endsection
