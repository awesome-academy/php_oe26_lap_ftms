<div id="preloader">
    <div id="spinner">
        <div class="preloader-dot-loading">
            <div class="cssload-loading"></div>
        </div>
    </div>
    <div id="disable-preloader" class="btn btn-default btn-sm">{{ trans('layouts.disable') }}</div>
</div>
<header id="header" class="header">
    <div class="header-top bg-theme-color-2 sm-text-center p-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="widget no-border m-0">
                        <ul class="list-inline font-13 sm-text-center mt-5">
                                <a class="text-white" id="logout" href="{{ route('logout') }}">{{ trans('layouts.logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                            <li class="text-white">|</li>
                            <li class="text-white">
                                <a class="text-white"  href="{{ route('user.show', Auth::user()->id) }}">{{ trans('layouts.profile') }}</a>
                            </li>
                            @if(Auth::user()->role_id == config('client.user.true'))
                                <li class="text-white">|</li>
                                <li class="text-white">
                                    <a class="text-white"  href="{{ route('admin.dashboard.index') }}">{{ trans('layouts.admin') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="widget m-0 pull-right sm-pull-none sm-text-center">
                        <ul class="list-inline pull-right">
                            <li class="mb-0 pb-0">
                                <div class="top-dropdown-outer pt-5 pb-10">
                                    <a class="top-cart-link has-dropdown text-white text-hover-theme-colored"><i class="fa fa-shopping-cart font-13"></i></a>
                                </div>
                            </li>
                            <li class="mb-0 pb-0">
                                <div class="top-dropdown-outer pt-5 pb-10">
                                    <a class="top-search-box has-dropdown text-white text-hover-theme-colored"><i class="fa fa-search font-13"></i> &nbsp;</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="widget no-border m-0 mr-15 pull-right flip sm-pull-none sm-text-center">
                        <ul class="styled-icons icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
                            <li><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus text-white"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram text-white"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle p-0 bg-lightest xs-text-center">
        <div class="container pt-0 pb-0">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-5">
                    <div class="widget no-border m-0">
                        <a class="menuzord-brand pull-left flip xs-pull-center mb-15" href="javascript:void(0)"><img src="{{ asset('bower_components/assets-client/images/logo-wide.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
                        <ul class="list-inline">
                            <li><i class="fa fa-phone-square text-theme-colored font-36 mt-5 sm-display-block"></i></li>
                            <li>
                                <a href="#" class="font-12 text-gray text-uppercase">{{ trans('layouts.call') }}</a>
                                <h5 class="font-14 m-0">{{ _('+(012) 345 6789') }}</h5>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
                        <ul class="list-inline">
                            <li><i class="fa fa-clock-o text-theme-colored font-36 mt-5 sm-display-block"></i></li>
                            <li>
                                <a href="#" class="font-12 text-gray text-uppercase">{{ trans('layouts.open') }}</a>
                                <h5 class="font-13 text-black m-0"> {{ trans('layouts.hour') }}</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav">
        <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored border-bottom-theme-color-2-1px">
            <div class="container">
                <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive">
                    <ul class="menuzord-menu">
                        <li class="active">
                            <a href="{{ route('home') }}">{{ trans('layouts.home') }}</a>
                        </li>
                        <li><a href="{{ route('course.index') }}">{{ trans('layouts.courses') }}</a>
                        </li>
                        <li>
                            <a href="">{{ trans('layouts.subject') }} <span class="label label-info">{{ trans('layouts.new') }}</span></a>
                        </li>
                        <li>
                            <a href="#home">{{ trans('layouts.task') }}</a>
                        </li>
                        <li>
                            <a href="#">{{ trans('layouts.active') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('calendar.show') }}">{{ trans('layouts.calendar') }}</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
