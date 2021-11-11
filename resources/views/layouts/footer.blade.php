<!-- BEGIN VENDOR JS -->
<script src="{{ asset('assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<!--  A polyfill for browsers that don't support ligatures: remove liga.js if not needed-->
<script src="{{ asset('assets/plugins/liga.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/modernizr.custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/popper/umd/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery/jquery-easy.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-ios-list/jquery.ioslist.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-actual/jquery.actual.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('assets/plugins/classie/classie.js') }}" type="text/javascript" ></script>
<script src="{{ asset('assets/plugins/nvd3/lib/d3.v3.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/plugins/nvd3/nv.d3.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/nvd3/src/utils.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/nvd3/src/tooltip.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/nvd3/src/interactiveLayer.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/nvd3/src/models/axis.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/nvd3/src/models/line.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/nvd3/src/models/lineWithFocusChart.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/mapplic/js/hammer.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/mapplic/js/jquery.mousewheel.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/mapplic/js/mapplic.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/rickshaw/rickshaw.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/skycons/skycons.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
{{--<script src="{{ asset('assets/plugins/moment/moment-with-locales.min.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('assets/plugins/jquery-autonumeric/autoNumeric.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.js') }}" type="text/javascript"></script>
<!-- END VENDOR JS -->
{{--<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>--}}
<script src="{!! mix('js/app.js') !!}" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{ asset('pages/js/pages.js') }}" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{ asset('assets/js/scripts.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.38.0/js/tempusdominus-bootstrap-4.min.js" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>--}}
{{--<script src="{{ asset('assets/js/dashboard.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('assets/js/scripts.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/reservation.js') }}" type="text/javascript"></script>
@yield('scripts')
<!-- END PAGE LEVEL JS -->
