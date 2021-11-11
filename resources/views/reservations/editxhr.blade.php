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
            <form action="{{ route('reservations.update', ['reservation' => $reservation]) }}" method="POST" id="reservation_form" role="form" autocomplete="off" novalidate>
                @method('PATCH')
                @csrf
                @include('reservations.form')
                <br>
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-6">
                        <button class="btn btn-success" style="color:#fff;" type="submit">Sauvegarder</button>
{{--                        <button class="btn btn-primary" type="submit">Envoyer la confirmation</button>--}}
{{--                            <button class="btn btn-primary" type="button" onclick="close_form()">Envoyer la confirmation</button>--}}
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
                                    <button type="button" class="btn btn-primary" id="dismissDeleteModal">Annuler</button>
                                    <button class="btn btn-danger" style="color:#fff" type="submit">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
        </div>
    </div>
</div>
{{--@section('script')--}}
{{--    <script src="{{ asset('js/reservationxhr.js') }}" type="text/javascript"></script>--}}
{{--@endsection--}}
