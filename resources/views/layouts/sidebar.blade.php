<!-- BEGIN SIDEBPANEL-->
<nav class="page-sidebar" data-pages="sidebar">
    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        {{--        <img src="assets/img/logo_white.png" alt="logo" class="brand" data-src="assets/img/logo_white.png" data-src-retina="assets/img/logo_white_2x.png" width="78" height="22">--}}
        <div class="sidebar-header-controls">
            <button aria-label="Toggle Drawer" type="button" class="btn btn-icon-link invert sidebar-slide-toggle m-l-20 m-r-10" data-pages-toggle="#appMenu">
                <i class="pg-icon">chevron_down</i>
            </button>
            <button aria-label="Pin Menu" type="button" class="btn btn-icon-link invert d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none" data-toggle-pin="sidebar">
                <i class="pg-icon"></i>
            </button>
        </div>
    </div>
    <!-- END SIDEBAR MENU HEADER-->
    <!-- START SIDEBAR MENU -->
    <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items">
            <li class="m-t-20 ">
                <a href="{{ route('reservations.calendar') }}">
                    <span class="title">Calendrier</span>
                    <span class="arrow"></span>
                </a>
                <span class="icon-thumbnail"><i class="pg-icon">calendar</i></span>
            </li>
            <li class="">
                <a href="{{ route('reservations.index') }}">
                    <span class="title">Réservations</span>
                </a>
                <span class="icon-thumbnail"><i class="pg-icon">brush</i></span>
            </li>
            <li class="">
                <a href="{{ route('reservations.create') }}">
                    <span class="title">Ajouter réservation</span>
                </a>
                <span class="icon-thumbnail"><i class="pg-icon">brush</i></span>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL-->
