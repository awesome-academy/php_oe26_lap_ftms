@extends('admin.layouts.main')
@section('title', config('configtask.edit_task'))
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
                        <div class="col-sm-12 col-sm-offset-3 col-lg-12 col-lg-offset-2 main">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
                                                        </div>
                                                    @endif
                                                    <form action="{{ route('admin.tasks.update', $task->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.subject') }}</label>
                                                            <select class="form-control" name="subject_id" id="">
                                                                <option>{{ trans('setting.root') }}</option>
                                                                @forelse ($subjects as $subject)
                                                                    <option
                                                                        @if ($task->subject_id == $subject->id)
                                                                            selected
                                                                        @endif
                                                                    value="{{ $subject->id }}">
                                                                        {{ $subject->name }}
                                                                    </option>
                                                                @empty
                                                                    <option>{{ trans('setting.empty') }}</option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.name') }}</label>
                                                            <input type="text" class="form-control" name="name" id="" value="{{ $task->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.description') }}</label>
                                                            <textarea class="form-control" name="description" id="" cols="{{ config('configtask.cols_textarea') }}" rows="{{ config('configtask.rows_textarea') }}">{{ $task->description }}</textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">{{ trans('setting.edit') }}</button>
                                                    </form>
                                                </div>
                                            </div>
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
