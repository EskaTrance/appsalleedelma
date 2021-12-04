@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Client</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>Nom de l'entreprise</td>
                    <td>{{ $reservation->client->enterprise_name }}</td>
                </tr>
                <tr>
                    <td>Prénom</td>
                    <td>{{ $reservation->client->firstname }}</td>
                </tr>
                <tr>
                    <td>Nom de famille</td>
                    <td>{{ $reservation->client->lastname }}</td>
                </tr>
                <tr>
                    <td>Téléphone</td>
                    <td>{{ $reservation->client->telephone }}</td>
                </tr>
                <tr>
                    <td>Téléphone 2</td>
                    <td>{{ $reservation->client->cellphone1 }}</td>
                </tr>
                <tr>
                    <td>Téléphone 3</td>
                    <td>{{ $reservation->client->cellphone1 }}</td>
                </tr>
                <tr>
                    <td>Courriel</td>
                    <td>{{ $reservation->client->email }}</td>
                </tr>
                <tr>
                    <td>Notes client</td>
                    <td>{{ $reservation->client->notes }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Réservation</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>Type</td>
                    <td>
                        @switch($reservation->reservation_type)
                            @case('reservation')
                                Réservation
                            @break
                            @case('pre_reservation')
                                Pré-réservation
                            @break
                            @case('visit')
                                Visite
                            @break
                        @endswitch
                    </td>
                </tr>
                <tr>
                    <td>No de facture</td>
                    <td>{{ $reservation->invoice_number }}</td>
                </tr>
                <tr>
                    <td>Type de client</td>
                    <td>
                        @switch($reservation->type)
                            @case('individual')
                                Particulier
                            @break
                            @case('enterprise')
                                Enterprise
                            @break
                            @case('eglise_espoir')
                                Église de l'Espoir
                            @break
                        @endswitch
                    </td>
                </tr>
                <tr>
                    <td>Date de l'appel</td>
                    <td>{{ $reservation->call_date ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Début de l'activité</td>
                    <td>{{ $reservation->start_date ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Fin de l'activité</td>
                    <td>{{ $reservation->end_date ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Nombre de personnes</td>
                    <td>{{ $reservation->guest_number }}</td>
                </tr>
                <tr>
                    <td>Permis d'alcool</td>
                    <td>{{ $reservation->liquor_license_needed ? 'Oui' : 'Non' }}</td>
                </tr>
            </table>
            <div class="card">
                <div class="card-header">
                    <h4>Paiement</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Méthode de paiement</td>
                            <td>
                                @switch($reservation->payment_type)
                                    @case('cash')
                                        Comptant
                                    @break
                                    @case('interac')
                                        Interac
                                    @break
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <td>Frais d'ouverture de dossier</td>
                            <td>{{ $reservation->booking_fees }}$ - {{ $reservation->booking_fees_paid ? 'Payé' : 'Non-payé' }}</td>
                        </tr>
                        <tr>
                            <td>Prix</td>
                            <td>{{ $reservation->price }}$ - {{ $reservation->price_paid ? 'Payé' : 'Non-payé' }}</td>
                        </tr>
                        <tr>
                            <td>Dépot de sécurité</td>
                            <td>{{ $reservation->security_deposit }}$ - {{ $reservation->security_deposit_paid ? 'Payé' : 'Non-payé' }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{ $reservation->booking_fees + $reservation->price }}$</td>
                        </tr>
                        <tr>
                            <td>Date de retour du dépôt</td>
                            <td>{{ $reservation->security_deposit_return_date ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Notes</td>
                            <td>{{ $reservation->notes }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
