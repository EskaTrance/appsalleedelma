@extends('layouts.app')
@section('content')
        <!-- START CONTAINER FLUID -->
        <div class="container">
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
                            <button type="button" id="cancelChanges" class="btn btn-secondary">Annuler les changements</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade slide-up disable-scroll" id="modalCancelChanges" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content-wrapper">
                        <div class="modal-content">
                            <div class="modal-body text-center m-t-20">
                                <h5 class="no-margin p-b-10">Annuler les changements ?</h5>
                                <button type="button" class="btn btn-primary btn" data-dismiss="modal">Non</button>
                                <button type="button" id="cancelChangesAccept" class="btn btn-danger" style="color:#fff">Oui</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
        </div>
        <!-- END CONTAINER FLUID -->
{{--    </div>--}}
@endsection
@section('scripts')
    <script src="{{ asset('js/dhtmlxscheduler.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dhtmlxscheduler_active_links.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dhtmlxscheduler_all_timed.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/locale_fr.js') }}" type="text/javascript"></script>
{{--    <script src="{{ asset('js/dhtmlxscheduler_quick_info.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('js/reservation.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scheduler.js') }}" type="text/javascript"></script>
@endsection
