@extends('admin.layouts.main')
@section('title', config('configsubject.edit_subject'))
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
                                                    <form action="{{ route('admin.subjects.update', $subject->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.name') }}</label>
                                                            <input type="text" class="form-control" name="name" value="{{ $subject->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.status') }}</label>
                                                            <select class="form-control" name="status" id="">
                                                                <option value="{{ config('configsubject.status_subject_open') }}" 
                                                                    @if ($subject->status == false)
                                                                        selected
                                                                    @endif >{{ trans('setting.open') }}
                                                                </option>
                                                                <option value="{{ config('configsubject.status_subject_waiting') }}" 
                                                                    @if ($subject->status == true)
                                                                        selected
                                                                    @endif>{{ trans('setting.waiting') }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group" id="add_main">
                                                            <label for="">{{ trans('setting.subject') }}</label> | 
                                                            <td>
                                                                <button type="button" id="btn_add" name="btn_add" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                                            </td>
                                                            @foreach ($course as $item)
                                                                <table class="table">
                                                                    <tr>
                                                                        <td>
                                                                            <select name="course_id[]" id="course_id" class="form-control">
                                                                                @foreach ($courses as $course)
                                                                                    <option 
                                                                                        @if ($item->id == $course->id)
                                                                                            selected
                                                                                        @endif
                                                                                        value="{{ $course->id }}">
                                                                                        {{ $course->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" id="btn_remove_edit" name="btn_remove_edit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            @endforeach
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.description') }}</label>
                                                            <textarea class="form-control" name="description" id="" cols="{{ config('configsubject.cols_textarea') }}" rows="{{ config('configsubject.rows_textarea') }}">{{ $subject->description }}</textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">{{ trans('setting.edit_subject') }}</button>
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
        <div class="form-group d-none" id="option_subject">
                <table id="input" class="table">
                    <tr>
                        <td>
                            <select name="course_id[]" id="course_id"
                                class="form-control">
                                @foreach ($courses as $course)
                                <option value="{{ $course->id }}">
                                    {{ $course->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" id="btn_remove" name="btn_remove"class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
                </table>
            </div>
        @include('admin.layouts.footer')
    </div>
</div>
@endsection
