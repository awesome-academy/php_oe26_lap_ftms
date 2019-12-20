@extends('client.layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 blog-pull-right">
                    @foreach ($courses as $course)
                        <div class="row mb-15">
                            <div class="col-sm-6 col-md-4">
                                <div class="thumb">
                                    <img alt="featured project" src="{{ $course->image }}" class="img-fullwidth">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-8">
                                <h4 class="line-bottom mt-0 mt-sm-20">{{ $course->name }}
                                @foreach ($course->users as $user)
                                    @if ($user->id == Auth::user()->id)
                                        @if ($user->pivot->status == config('client.user.false'))
                                            <i class="fa fa-check-circle check"></i>
                                        @elseif ($user->pivot->status == config('client.user.true'))
                                            <i class="fa fa-check-circle nocheck"></i>
                                        @endif
                                    @endif
                                @endforeach
                                </h4>
                                <p>{{ $course->description }}</p>
                                <em>{{ $course->users->count() }} {{ trans('layouts.member') }}</em><br>
                                <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="{{ route('course.show', $course->id) }}">{{ trans('layouts.viewD') }}</a>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <div class="row">
                        <div class="col-sm-12">
                            <nav>
                                {{ $courses->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sidebar sidebar-left mt-sm-30">
                        <div class="widget">
                            <h5 class="widget-title line-bottom">{{ trans('layouts.categories') }}</h5>
                            <div class="categories">
                                <ul class="list list-border angle-double-right">
                                    <li><a href="{{ route('course.index') }}">{{ trans('layouts.all') }}<span></span></a></li>
                                    @foreach ($categories as $category)
                                        @if ($category->categories->count() > config('client.user.false'))
                                        <li><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}<span></span></a></li>
                                        <ul>
                                            @foreach ($category->categories as $categoryChild)
                                                <li>
                                                    <a href="{{ route('category.show', $categoryChild->id) }}">{{ $categoryChild->name }}
                                                        <span>{{ '(' . $categoryChild->courses->count() . ')' }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
