@extends('admin.layouts.main')
@section('title', config('configtask.list_task'))
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
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="bootstrap-table">
                                            <div class="table-responsive">
                                                <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary">{{ trans('setting.add_task') }}</a>
                                                <table class="table table-bordered" id="table-show">
                                                    <thead>
                                                        <tr class="bg-primary">
                                                            <th id="th-id">{{ trans('setting.id') }}</th>
                                                            <th>{{ trans('setting.name') }}</th>
                                                            <th>{{ trans('setting.subject') }}</th>
                                                            <th>{{ trans('setting.description') }}</th>
                                                            <th id="th-option">{{ trans('setting.options') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($tasks as $task)
                                                        <tr>
                                                            <td>{{ $task->id }}</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <p>{{ $task->name }}</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $task->subject->name }}</td>
                                                            <td>
                                                                <p>{{ $task->description }}</p>
                                                            </td>
                                                            <td>
                                                                <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a href="{{ route('admin.tasks.show', $task->id) }}" class="btn btn-primary"><i class="far fa-eye"></i></a>
                                                                    <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                                                    <button class="btn btn-danger checkconfirm" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div align='right'>
                                                    {{ $tasks->links() }}
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
