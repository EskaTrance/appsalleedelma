<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>Pages - Admin Dashboard UI Kit - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>
{{--    <link rel="apple-touch-icon" href="pages/ico/60.png">--}}
{{--    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">--}}
{{--    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">--}}
{{--    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">--}}
{{--    <link rel="icon" type="image/x-icon" href="favicon.ico"/>--}}
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Meet pages - The simplest and fastest way to build web UI for your dashboard or app." name="description"/>
    <meta content="Ace" name="author"/>
    <link href="{{ asset('assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('assets/plugins/nvd3/nv.d3.min.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('assets/plugins/mapplic/css/mapplic.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/rickshaw/rickshaw.min.css') }}" rel="stylesheet" type="text/css"/>
{{--    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.38.0/css/tempusdominus-bootstrap-4.min.css" crossorigin="anonymous" />--}}
    <link class="main-stylesheet" href="{{ asset('css/corporate.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/dhtmlxscheduler.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/dhtmlxscheduler_material.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Please remove the file below for production: Contains demo classes -->
{{--    <link class="main-stylesheet" href="assets/css/style.css" rel="stylesheet" type="text/css"/>--}}
</head>

<body class="fixed-header dashboard menu-pin menu-behind">
    @include('layouts.sidebar')
    <div class="page-container">
        @include('layouts.header')
        <div class="page-content-wrapper">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>
