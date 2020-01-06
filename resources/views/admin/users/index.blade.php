@extends('admin.layouts.main')
@section('title', config('configuser.list_user'))
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
                    <div>
                        <div class="bootstrap-table">
                            <div class="table-responsive">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">{{ trans('setting.add_user') }}</a>
                                <hr>
                                @if (session('alert'))
                                    <div class="alert alert-success"><i class="fas fa-check"></i>{{ session('alert') }}</div>
                                @endif
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>{{ trans('setting.id') }}</th>
                                            <th>{{ trans('setting.name') }}</th>
                                            <th>{{ trans('setting.avatar') }}</th>
                                            <th>{{ trans('setting.email') }}</th>
                                            <th>{{ trans('setting.address') }}</th>
                                            <th>{{ trans('setting.phone') }}</th>
                                            <th>{{ trans('setting.role') }}</th>
                                            <th>{{ trans('setting.options') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td><b>{{ $user->name }} <b></td>
                                            <td><img class="avt" id="avatar-user" src="{{ $user->avatar }}"></td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                @if ($user->role_id == false)
                                                    <button class="btn btn-success">{{ trans('setting.trainee') }}</button>
                                                @else
                                                    <button class="btn btn-danger">{{ trans('setting.supervisor') }}</button>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    @if (Auth::User()->role_id >= $user->role_id)
                                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary"><i class="far fa-eye"></i></a>
                                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>        
                                                    @endif
                                                    @if (Auth::User()->role_id > $user->role_id)
                                                        <button type="submit" class="btn btn-danger checkconfirm"><i class="far fa-trash-alt"></i></button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                        @empty

                                        @endforelse
                                    </tbody>
                                </table>
                                <div align='right'>
                                    {{ $users->links() }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
    </div>
</div>
@endsection
