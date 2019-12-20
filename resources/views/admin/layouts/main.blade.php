<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title') | {{ trans('setting.project') }}</title>
    <link href="{{ asset('bower_components/assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/assets/admin/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/assets/admin/css/sb-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatable/DataTables/datatables.min.css') }}"/>
</head>

<body id="page-top">
    @include('admin.layouts.header')
    <div id="wrapper">
        @include('admin.layouts.sidebar')
        <div id="content-wrapper">
            @yield('content')
            @include('admin.layouts.footer')
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('bower_components/assets/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/js/sb-admin.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/datatable/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets-client/js/custom.js') }}"></script>

</body>

</html>
