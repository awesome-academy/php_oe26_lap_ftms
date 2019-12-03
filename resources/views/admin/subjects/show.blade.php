@extends('admin.layouts.main')
@section('title', config('configsubject.show_subject'))
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
                <i class="fas fa-atom"></i>
                <span>@yield('title')</span>
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-3">
                                <div>
                                    <ul>
                                        <li><b>{{ trans('setting.id') }} </b> {{ $subject->id }}</li>
                                        <li><b>{{ trans('setting.name') }}</b> {{ $subject->name }}</li>
                                        <li><b>{{ trans('setting.status') }}</b>
                                            @if ($subject->status == true)
                                                <b>{{ trans('setting.waiting') }}</b>
                                            @else
                                                <b>{{ trans('setting.open') }}</b>
                                            @endif
                                        </li>
                                        <li><b>{{ trans('setting.description') }}</b> {{ $subject->description }}</li>
                                        <hr>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">{{ trans('setting.assign_user') }}</button>
                                    </ul>
                                </div>
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <label for="">{{ trans('setting.assign_user') }}</label>
                                            </div>
                                            <form action="{{ route('assignTraineeSubject', $subject->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <select class="form-control" name="user_id">
                                                        @foreach ($listUser as $user)
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
                                <div class="vertical-menu">
                                    <div class="item-menu active">{{ trans('setting.list_task') }}</div>
                                    @foreach ($tasks as $item)
                                        <div class="item-menu">
                                            <span>{{ $item->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered" id="table-show">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>{{ trans('setting.id') }}</th>
                                            <th>{{ trans('setting.name') }}</th>
                                            <th>{{ trans('setting.email') }}</th>
                                            <th>{{ trans('setting.status') }}</th>
                                            <th>{{ trans('setting.process') }}</th>
                                            <th id="option">{{ trans('setting.options') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
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
                                                        @if ($item->status == config('configsubject.status_user_activity'))
                                                            <button class="btn btn-warning">{{ trans('setting.activity') }}</button>
                                                        @else
                                                            <button class="btn btn-success">{{ trans('setting.success') }}</button>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($statusUser as $item)
                                                    @if ($user->id == $item->user_id)
                                                        {{ $item->process }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <form id="finish-form" action="{{ route('finishTraineeSubject', $subject->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    @foreach ($statusUser as $item)
                                                        @if ($item->user_id == $user->id)
                                                            @if ($item->status == config('configsubject.status_user_activity'))
                                                                <input class="d-none" type="hidden" name="user_id" value="{{ $item->user_id }}">
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
                                            <td>{{ trans('setting.subject_empty') }}
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
