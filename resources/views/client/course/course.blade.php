@extends('client.layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 blog-pull-right" id="content">
                    <div class="single-service">
                        <img src="{{ $course->image }}" alt="">
                        <h3 class="text-theme-colored">{{ $course->name }}</h3>
                        <em data-toggle="modal" data-target="#myModal"><a>{{ $course->users->count() }} {{ trans('layouts.member') }}</a></em>
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ trans('layouts.member') }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-borderless table-striped">
                                            @foreach ($course->users as $user)
                                                <tr>
                                                    <th class="col-xs-1"><img src="{{ $user->avatar }}"></th>
                                                    <th><h5><b>{{ $user->name }}</b></h5></th>
                                                    <th class="col-xs-1"><a href="{{ route('user.show', $user->id) }}" class="btn btn-success">{{ trans('layouts.viewP') }}</a></th>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('layouts.close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>{{ $course->description }}</p>
                        @foreach ($course->users as $user)
                            @if ($user->id == Auth::user()->id)
                                <p>{{ trans('layouts.Complete') }}{{ ': ' . $user->pivot->status . '/' . $course->subjects->count() }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="sidebar sidebar-left mt-sm-30 ml-40">
                        <div class="widget">
                            <h4 class="widget-title line-bottom">{{ trans('layouts.course') }}
                            <strong>{{ $course->name }}</strong></h4>
                            <div class="services-list">
                                <ul class="list list-border angle-double-right" id="list">
                                    <li class="active" id="introduction"><a href="{{ route('course.show', $course->id) }}">{{ trans('layouts.intro') }}</a>
                                    </li>
                                    @foreach ($course->subjects as $subject)
                                        <li class='ml-20' id="subject{{ $subject->id }}" value="{{ $course->id }}"><a>{{ $subject->name }}</a></li>
                                    @endforeach
                                    <li id="history{{ $course->id }}" value="{{ $course->id }}"><a>{{ trans('layouts.history') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
