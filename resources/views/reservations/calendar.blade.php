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
            <div id="scheduler_reservation_lightbox" class="modal fade">
{{--            <div id="scheduler_reservation_lightbox" class="modal fade" style="width:100%!important; max-width: 800px!important;">--}}
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal_title">New Event</h5>
                            <button type="button" id="close_modal" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="form_lightbox" class="modal-body" style="padding: 0">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler les changements</button>
                        </div>
                    </div>
                </div>
{{--                <div class="dhx_cal_ltitle" role="heading" style="cursor: move;">--}}
{{--                    <span class="dhx_mark">&nbsp;</span><span class="dhx_time">13:30 - 13:35</span><span class="dhx_title">New event</span>--}}
{{--                </div>--}}
{{--                <div class="dhx_cal_larea">--}}
{{--                    <div id="form_lightbox" class="dhx_wrap_section">--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
        <!-- END CONTAINER FLUID -->
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/dhtmlxscheduler.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dhtmlxscheduler_active_links.js') }}" type="text/javascript"></script>
{{--    <script src="{{ asset('js/dhtmlxscheduler_quick_info.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('js/scheduler.js') }}" type="text/javascript"></script>
@endsection
