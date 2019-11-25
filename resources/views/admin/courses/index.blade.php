@extends('admin.layouts.main')
@section('title', config('configcourse.list_course'))
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">{{ trans('setting.courses') }}</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chalkboard-teacher"></i> |
                <span> @yield('title') </span>
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="bootstrap-table">
                                            <div class="table-responsive">
                                                <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">{{ trans('setting.add_course') }}</a>
                                                <hr>
                                                @if (session('alert'))
                                                    <div class="alert alert-success"><i class="fas fa-check"></i> {{ session('alert') }}</div>
                                                @endif
                                                <table class="table table-bordered" id="table-course">
                                                    <thead>
                                                        <tr class="bg-primary">
                                                            <th>{{ trans('setting.id') }}</th>
                                                            <th>{{ trans('setting.name') }}</th>
                                                            <th>{{ trans('setting.image') }}</th>
                                                            <th>{{ trans('setting.categories') }}</th>
                                                            <th>{{ trans('setting.status') }}</th>
                                                            <th>{{ trans('setting.description') }}</th>
                                                            <th id="option">{{ trans('setting.options') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($courses as $course)
                                                        <tr>
                                                            <td>{{ $course->id }}</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <p>
                                                                            <b>{{ $course->name }}</b>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <img id="show-image" src="{{ $course->image }}" alt="">
                                                            </td>
                                                            <td>{{ $course->category->name }}</td>
                                                            <td>
                                                                @if ($course->status == true))
                                                                    <button class="btn btn-success">
                                                                        <i class="fa fa-pencil" aria-hidden="true"></i> {{ trans('setting.open') }}
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-success">
                                                                        <i class="fa fa-pencil" aria-hidden="true"></i> {{ trans('setting.waiting') }}
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <p>{{ $course->description }}</p>
                                                            </td>
                                                            <td>
                                                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-primary"><i class="far fa-eye"></i></a>
                                                                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                                                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td>
                                                                {{ trans('setting.course_empty') }}
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
                                                <div align='right'>
                                                    {{ $courses->links() }}
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
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
