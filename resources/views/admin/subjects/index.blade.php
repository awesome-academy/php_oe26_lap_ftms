@extends('admin.layouts.main')
@section('title', config('configsubject.list_subject'))
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
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="bootstrap-table">
                                            <div class="table-responsive">
                                                <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">{{ trans('setting.add_subject') }}</a>
                                                <hr>
                                                @if (session('alert'))
                                                    <div class="alert alert-success">{{ session('alert') }}</div>
                                                @endif
                                                @if (session('error'))
                                                    <div class="alert alert-error">{{ session('error') }}</div>
                                                @endif
                                                    <table class="table table-bordered text-center" id="table-show">
                                                        <thead>
                                                            <tr class="bg-primary">
                                                                <th id="id">{{ trans('setting.id') }}</th>
                                                                <th>{{ trans('setting.name') }}</th>
                                                                <th id="courses">{{ trans('setting.courses') }}</th>
                                                                <th id="status">{{ trans('setting.status') }}</th>
                                                                <th>{{ trans('setting.description') }}</th>
                                                                <th id="option">{{ trans('setting.options') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($subjects as $subject)
                                                            <tr>
                                                                <td>{{ $subject->id }}</td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <p>{{ $subject->name }}</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    @foreach ($subject->courses as $course)
                                                                        <ul>
                                                                            <li>{{ $course->name }}</li>
                                                                        </ul>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    @if ($subject->status == false)
                                                                        <button class="btn btn-success">{{ trans('setting.open') }}</button>
                                                                    @else
                                                                        <button class="btn btn-warning">{{ trans('setting.waiting') }}</button>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <p>{{ $subject->description }}</p>
                                                                </td>
                                                                <td>
                                                                    <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a href="{{ route('admin.subjects.show', $subject->id) }}" class="btn btn-primary">
                                                                            <i class="far fa-eye"></i>
                                                                        </a>
                                                                        <a href="{{ route('admin.subjects.edit', $subject->id) }}" class="btn btn-warning">
                                                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                                                        </a>
                                                                        <button type="submit" class="btn btn-danger checkconfirm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </form>
                                                <div align='right'>
                                                    {{ $subjects->links() }}
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
