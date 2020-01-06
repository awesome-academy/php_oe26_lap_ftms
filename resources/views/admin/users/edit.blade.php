@extends('admin.layouts.main')
@section('title', config('configuser.edit_user'))
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
                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
                            <div class="row">
                                <div class="col-xs-6 col-md-12 col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-body">
                                            <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                @if ($errors->any())
                                                    <div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i>{{ $errors->first() }}</div>
                                                @endif
                                                @if (session('alert'))
                                                    <div class="alert alert-success">{{ session('alert') }}</div>
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>{{ trans('setting.user') }}</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ trans('setting.email') }}</label>
                                                            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ trans('setting.password') }}</label>
                                                            <input type="password" name="password" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ trans('setting.confirm_password') }}</label>
                                                            <input type="password" name="repassword" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ trans('setting.phone') }}</label>
                                                            <input type="number" name="phone" class="form-control" value="{{ $user->phone }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ trans('setting.address') }}</label>
                                                            <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ trans('setting.role') }}</label>
                                                            <select name="role_id" class="form-control">
                                                                <option value="{{ config('configuser.trainee') }}" @if ($user->role_id == false) selected @endif >
                                                                    {{ trans('setting.trainee') }}
                                                                </option>
                                                                <option value="{{ config('configuser.supervisor') }}" @if ($user->role_id == true) selected @endif >
                                                                    {{ trans('setting.supervisor') }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-success" name="add-product" type="submit">{{ trans('setting.edit_user') }}</button>
                                                            <button class="btn btn-danger" type="reset">{{ trans('setting.reset') }}</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>{{ trans('setting.avatar') }}</label>
                                                            <input id="img" type="file" name="avatar" class="form-control hidden">
                                                            <img id="avatar" class="thumbnail img-fluid" src="{{ $user->avatar }}">
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
        @include('admin.layouts.footer')
    </div>
</div>
@endsection
