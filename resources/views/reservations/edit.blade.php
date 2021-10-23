@extends('layouts.app')
@section('content')
{{--    <div class="jumbotron" data-pages="parallax">--}}
{{--        <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">--}}
{{--            <div class="inner">--}}
{{--                <!-- START BREADCRUMB -->--}}
{{--                <ol class="breadcrumb">--}}
{{--                    <li class="breadcrumb-item"><a href="#">Pages</a></li>--}}
{{--                    <li class="breadcrumb-item active">Blank template</li>--}}
{{--                </ol>--}}
{{--                <!-- END BREADCRUMB -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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
                <form action="{{ route('reservations.update', ['reservation' => $reservation]) }}" method="POST" id="form-project" role="form" autocomplete="off" novalidate>
                    @method('PATCH')
                    @csrf
                    @include('reservations.form')
                    <br>
                    <div class="row">
                        <div class=" col-12 col-md-8 col-lg-6">
                            <button class="btn btn-success" style="color:#fff;" type="submit">Sauvegarder</button>
                            <button class="btn btn-primary" type="submit">Envoyer la confirmation</button>
                            <!-- Button trigger modal -->
                            <button class="btn btn-danger pull-right" style="color:#fff" type="button"  data-toggle="modal" data-target="#modalDelete">Supprimer</button>
                        </div>
                    </div>
                </form>
                <div class="modal fade slide-up disable-scroll" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="false">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content-wrapper">
                            <div class="modal-content">
                                <div class="modal-body text-center m-t-20">
                                    <form action="{{ route('reservations.destroy', ['reservation' => $reservation]) }}" method="POST" role="form" autocomplete="off" novalidate>
                                        @method('DELETE')
                                        @csrf
                                        <h5 class="no-margin p-b-10">Supprimer la réservation ?</h5>
                                        <button type="button" class="btn btn-primary btn-cons" data-dismiss="modal">Annuler</button>
                                        <button class="btn btn-danger" style="color:#fff" type="submit">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
{{--                <form action="{{ route('reservations.destroy', ['reservation' => $reservation]) }}" method="POST" role="form" autocomplete="off" novalidate>--}}
{{--                    @method('DELETE')--}}
{{--                    @csrf--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-6">--}}
{{--                            <button class="btn btn-danger" style="color:#fff" type="submit">Supprimer</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
            </div>
        </div>
    </div>
@endsection

