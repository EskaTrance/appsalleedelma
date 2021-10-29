@extends('layouts.app')
@section('content')
    <div class="content ">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active">Blank template</li>
                    </ol>
                    <!-- END BREADCRUMB -->
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg">
            <div id="scheduler" class="dhx_cal_container" style='width:100%; height:600px;'>
                <div class="dhx_cal_navline">
                    <div class="dhx_cal_prev_button">&nbsp;</div>
                    <div class="dhx_cal_next_button">&nbsp;</div>
                    <div class="dhx_cal_today_button"></div>
                    <div class="dhx_cal_date"></div>
                    <div class="dhx_cal_tab" name="day_tab"></div>
                    <div class="dhx_cal_tab" name="week_tab"></div>
                    <div class="dhx_cal_tab" name="month_tab"></div>
                </div>
                <div class="dhx_cal_header"></div>
                <div class="dhx_cal_data"></div>
            </div>
        </div>
        <div id="reservation_form"></div>
        <!-- END CONTAINER FLUID -->
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/dhtmlxscheduler.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dhtmlxscheduler_active_links.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dhtmlxscheduler_quick_info.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scheduler.js') }}" type="text/javascript"></script>
@endsection
