@extends('admin.layouts.main')
@section('title', config('configtask.show_task'))
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
                <i class="fas fa-book-open"></i>
                <span>@yield('title')</span>
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <ul>
                                        <li><b>{{ trans('setting.id') }} </b> {{ $task->id }}</li>
                                        <li><b>{{ trans('setting.name') }} </b> {{ $task->name }}</li>
                                        <li><b>{{ trans('setting.subject') }} </b> {{ $task->subject_id }} </li>
                                        <li><b>{{ trans('setting.status') }} </b>
                                            @if ($task->status == true)
                                                <b>{{ trans('setting.waiting') }}</b>
                                            @else
                                                <b>{{ trans('setting.open') }}</b>
                                            @endif
                                        </li>
                                        <li><b>{{ trans('setting.description') }} </b> {{ $task->description }}</li>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">{{ trans('setting.assign_user') }}</button>
                                    </ul>
                                </div>
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <label for="">{{ trans('setting.assign_user') }}</label>
                                            </div>
                                            <form action="{{ route('assignTraineeTask', $task->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <select class="form-control" name="user_id">
                                                        @foreach ($listUsers as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }} | {{ $user->email }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">{{ trans('setting.add') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @if (session('alert'))
                                    <div class="alert alert-success">{{ session('alert') }}</div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-success">{{ session('error') }}</div>
                                @endif
                                <table class="table table-bordered" id="table-show">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>{{ trans('setting.id') }}</th>
                                            <th>{{ trans('setting.name') }}</th>
                                            <th>{{ trans('setting.email') }}</th>
                                            <th>{{ trans('setting.status') }}</th>
                                            <th id="option">{{ trans('setting.options') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($userTask as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p><b>{{ $user->name }}</b></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @foreach ($statusUser as $item)
                                                        @if ($item->user_id == $user->id)
                                                            @if ($item->status == config('configtask.status_user_activity'))
                                                                <button class="btn btn-warning">{{ trans('setting.activity') }}</button>
                                                            @else
                                                                <button class="btn btn-success">{{ trans('setting.success') }}</button>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <form id="finish-form" action="{{ route('finishTraineeTask', $task->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        @foreach ($statusUser as $item)
                                                            @if ($item->user_id == $user->id)
                                                                @if ($item->status == config('configtask.status_user_activity'))
                                                                    <input class="d-none" type="hidden" name="user_id" value="{{ $item->user_id }}">
                                                                    <input class="d-none" type="hidden" name="subject_id" value="{{ $task->subject_id }}">
                                                                    <button type="submit" class="btn btn-info">{{ trans('setting.finish') }}</button>
                                                                @else
                                                                    <button class="btn btn-success">{{ trans('setting.finished') }}</button>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>{{ trans('setting.task_empty') }}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
