@extends('layouts.app')
@section('content')
    <div class="container">
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
            </div>
        </div>
        <form action="{{ route('reservations.store') }}" method="POST" id="reservation_form" role="form" autocomplete="off" novalidate>
            @csrf
            @include('reservations.form')
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/reservation.js') }}" type="text/javascript"></script>
@endsection
