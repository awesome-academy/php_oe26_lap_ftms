<footer id="footer" class="footer divider layer-overlay overlay-dark-9">
    <div class="container">
        <div class="row border-bottom">
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <img class="mt-5 mb-20" alt="" src="{{ asset('bower_components/assets-client/images/logo-white-footer.png') }}">
                    <p>{{ trans('layouts.address1') }}</p>
                    <ul class="list-inline mt-5">
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">{{ trans('layouts.phone') }}</a> </li>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">{{ trans('layouts.domain') }}</a> </li>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">{{ trans('layouts.yourdomain') }}</a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h5 class="widget-title mb-10">{{ trans('layouts.call') }}</h5>
                    <div class="text-gray">
                        {{ trans('layouts.phone') }}
                        <br>{{ trans('layouts.phone') }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title">{{ trans('layouts.twitter') }}</h4>
                    <div class="twitter-feed list-border clearfix" data-username="Envato" data-count="2"></div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title line-bottom-theme-colored-2">{{ trans('layouts.open') }}</h4>
                    <div class="opening-hours">
                        <ul class="list-border">
                            <li class="clearfix"> <span>{{ trans('layouts.hour') }}</span>
                                <div class="value pull-right">{{ trans('layouts.hour') }}</div>
                            </li>
                            <li class="clearfix"> <span>{{ trans('layouts.hour') }}</span>
                                <div class="value pull-right">{{ trans('layouts.hour') }}</div>
                            </li>
                            <li class="clearfix"> <span>{{ trans('layouts.hour') }}</span>
                                <div class="value pull-right">{{ trans('layouts.hour') }}</div>
                            </li>
                            <li class="clearfix"> <span>{{ trans('layouts.hour') }}</span>
                                <div class="value pull-right">{{ trans('layouts.hour') }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-black-333">
        <div class="container pt-20 pb-20">
            <div class="row">
                <div class="col-md-6">
                    <p class="font-11 text-black-777 m-0">{{ trans('layouts.copyright') }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
