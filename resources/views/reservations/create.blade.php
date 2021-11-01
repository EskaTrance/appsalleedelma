@extends('layouts.app')
@section('content')
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
    <div class="container-fluid container-fixed-lg">
        <div class="card">
            @if ($flash = session('success'))
                <div class="card-header">
                    <div class="alert alert-success" role="alert">
                        <button aria-label="" class="close" data-dismiss="alert"></button>
                        <strong>Succès: </strong> {{ $flash }}
                    </div>
                </div>
            @endif
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('reservations.store') }}" method="POST" id="form-project" role="form" autocomplete="off" novalidate>
                    @csrf
                    @include('reservations.form')
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <button class="btn btn-success pull-left" style="color:#fff;" type="submit">Sauvegarder la réservation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/reservation.js') }}" type="text/javascript"></script>
@endsection
