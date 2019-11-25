@extends('admin.layouts.main')
@section('title', config('configcourse.edit_course'))
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.courses.index') }}">{{ trans('setting.courses') }}</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chalkboard-teacher"></i> |
                <span> @yield('title') </span>
                <div class="card-body">
                    <div>
                        <div class="col-sm-12 col-sm-offset-3 col-lg-12 col-lg-offset-2 main">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <form action="{{ route('admin.courses.update', $course->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}</div>
                                                        @endif
                                                        <div class="form-group">
                                                            <label for=""> {{ trans('setting.category') }} :</label>
                                                            <select class="form-control" name="category_id" id="">
                                                                @forelse ($categories as $category)
                                                                    <option 
                                                                        @if ($category->id == $course->category_id)
                                                                            selected
                                                                        @endif
                                                                        value="{{ $category->id }}">{{ $category->name }}
                                                                    </option>
                                                                @empty
                                                                    <option value="">-----{{ trans('setting.empty') }}-----</option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.name') }}</label>
                                                            <input type="text" class="form-control" name="name" id="" value="{{ $course->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.status') }}</label>
                                                            <select class="form-control" name="status" id="">
                                                                <option @if ($course->status == false)
                                                                    selected
                                                                    @endif
                                                                    value="{{ config('configcourse.status_coruse_open') }}">{{ trans('setting.open') }}</option>
                                                                <option @if ($course->status == true)
                                                                    selected
                                                                    @endif
                                                                    value="{{ config('configcourse.status_course_open') }}">{{ trans('setting.waiting') }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.subject') }}</label> |
                                                            <button type="button" id="btn_add" name="btn_add" class="btn btn-primary">{{ trans('setting.add') }}</button>
                                                            @foreach ( $subject as $subject)
                                                                <table id="add_main" class="table">
                                                                    <tr>
                                                                        <td>
                                                                            <select name="subject_id[]" id="subject_id" class="form-control">
                                                                                @foreach ($subjects as $item)
                                                                                    <option 
                                                                                        @if ($subject->id == $item->id) 
                                                                                            selected
                                                                                        @endif value="{{ $item->id }}">
                                                                                        {{ $item->name }} 
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
                                                            <textarea class="form-control" name="description" id="" cols="{{ config('configcourse.cols_textarea') }}" rows="{{ config('configcourse.rows_textarea') }}">{{ $course->description }}</textarea>
                                                        </div>
                                                        <a href="{{ route('admin.courses.update', $course->id) }}">
                                                            <button type="submit" class="btn btn-primary">{{ trans('setting.edit_course') }}</button>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>{{ trans('setting.course_image') }}</label>
                                                            <input id="img" type="file" name="image" class="form-control hidden" onchange="changeImg(this)">
                                                            <img id="image-course" class="thumbnail" src="{{ $course->image }}">
                                                        </div>
                                                    </div>
                                                </div>
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
        <div class="form-group d-none" id="option_subject">
            <table id="input" class="table">
                <tr>
                    <td>
                        <select name="subject_id[]" id="subject_id" class="form-control">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><button type="button" id="btn_remove" name="btn_remove" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></td>
                </tr>
            </table>
        </div>
        @include('admin.layouts.footer')
    </div>
</div>
@endsection
