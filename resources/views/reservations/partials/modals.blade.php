<div class="modal fade slide-up disable-scroll" id="modalDeleteRepeating" tabindex="-1" role="dialog" aria-hidden="false">
    @if ($reservation->repeating_reservation_id)
        <div class="modal-dialog modal-sm">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-body text-left m-t-20">
                        <form action="{{ route('reservations.destroy-repeating', ['reservation' => $reservation]) }}" method="POST" id="delete_repeating_reservation_form" role="form" autocomplete="off" novalidate>
                            @method('DELETE')
                            @csrf
                            <h5 class="no-margin p-b-10">Supprimer les réservations récurrente ?</h5>
                            <p>Jour: {{ ucfirst($reservation->repeatingReservation->repeat_start->isoFormat('dddd')) }}<br/>
                                Début: {{ ucwords($reservation->repeatingReservation->repeat_start->isoFormat('dddd LL')) }}<br/>
                                Fin: {{ ucwords($reservation->repeatingReservation->repeat_end->isoFormat('dddd LL')) }}
                            </p>
                            <h6>Réservations</h6>
                            <p>Nombre de réservations: {{ $reservation->repeatingReservation->reservations->count() }}</p>
                            <ul>
                                @foreach($reservation->repeatingReservation->reservations->splice(0, 4) as $repeatedReservation)
                                    <li>{{ $repeatedReservation->start_date->isoFormat('lll') }} au <br/> {{ $repeatedReservation->end_date->isoFormat('lll') }}</li>
                                @endforeach
                                @if($reservation->repeatingReservation->reservations->count() > 4)
                                    <li>...</li>
                                @endif
                            </ul>
                            <button type="button" class="btn btn-primary btn-cons" data-dismiss="modal" id="dismissDeleteRepeating">Annuler</button>
                            <button class="btn btn-danger" style="color:#fff" type="submit">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="modal fade slide-up disable-scroll" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-body text-center m-t-20">
                    <form action="{{ route('reservations.destroy', ['reservation' => $reservation]) }}" method="POST" role="form" autocomplete="off" novalidate>
                        @method('DELETE')
                        @csrf
                        <h5 class="no-margin p-b-10">Supprimer la réservation ?</h5>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="dismissDeleteModal">Annuler</button>
                        <button class="btn btn-danger" style="color:#fff" type="submit">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
