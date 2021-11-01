<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div id="reservation_errors" class="alert alert-danger" style="display: none;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <form action="{{ route('reservations.store') }}" method="POST" id="reservation_form" role="form" autocomplete="off" novalidate>
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
{{--@section('script')--}}
{{--    <script src="{{ asset('js/reservationxhr.js') }}" type="text/javascript"></script>--}}
{{--@endsection--}}
