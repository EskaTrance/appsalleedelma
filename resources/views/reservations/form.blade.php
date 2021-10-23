@php
$clientId = old('client_id', $reservation->client_id);
@endphp
<h4>Client</h4>
<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="form-group form-group-default">
            <label for="client_search">Recherche de client</label>
            <input type="hidden" id="client.id" name="client[id]" value="{{ old('client_id', $reservation->client_id) }}">
            <input type="hidden" id="client_id" name="client_id" value="{{ old('client_id', $reservation->client_id) }}">
            <input type="text" id="client_search" class="form-control">
        </div>
    </div>
    <div class="col-md-2 col-lg-4">
        <button id="new_client" class="btn btn-success mt-2" type="button">Créer un nouveau client</button>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h5 id="current_client_id" class="{{ empty($clientId) ? 'hide' : '' }}">ID client: {{ $clientId }}</h5>
        <h5 id="new_client_id" class="{{ $clientId ? 'hide' : '' }}">Nouveau client</h5>
    </div>
</div>
<div class="form-group-attached">
    <div class="row clearfix">
        <div class="col-md-4 col-lg-3">
            <div class="form-group form-group-default">
                <label for="enterprise_name">Nom de l'entreprise</label>
                <input type="text" id="enterprise_name" name="client[enterprise_name]" value="{{ old('client.enterprise_name', $reservation->client->enterprise_name) }}" class="form-control">
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-4 col-lg-3">
            <div class="form-group form-group-default">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="client[firstname]" value="{{ old('client.firstname', $reservation->client->firstname) }}" class="form-control">
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="form-group form-group-default">
                <label for="lastname">Nom de famille</label>
                <input type="text" id="lastname" name="client[lastname]" value="{{ old('client.lastname', $reservation->client->lastname) }}" class="form-control">
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-4 col-lg-3">
            <div class="form-group form-group-default">
                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="client[telephone]" value="{{ old('client.telephone', $reservation->client->telephone) }}" class="form-control">
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="form-group form-group-default">
                <label for="email">Courriel</label>
                <input type="text" id="email" name="client[email]" value="{{ old('client.email', $reservation->client->email) }}" class="form-control">
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-6">
        <h6>Évaluation</h6>
        <div class="form-group required">
            <div class="form-check form-check-inline success">
                <input type="radio" id="accept" name="client[rating]" value="accept" {{ old('client.rating', $reservation->client->rating) === 'accept' || empty($reservation->client->rating) ? 'checked' : ''}}>
                <label for="accept">
                    Accepter
                </label>
            </div>
            <div class="form-check form-check-inline warning">
                <input type="radio" id="warning" name="client[rating]" value="warning" {{ old('client.rating', $reservation->client->rating) === 'warning' ? 'checked' : ''}}>
                <label for="warning">
                    Attention
                </label>
            </div>
            <div class="form-check form-check-inline danger">
                <input type="radio" id="block" name="client[rating]" value="block" {{ old('client.rating', $reservation->client->rating) === 'block' ? 'checked' : ''}}>
                <label for="block">
                    Bloquer
                </label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="client_notes" class="h6">Notes client</label>
            <textarea id="client_notes" name="client[notes]" class="form-control" rows="2" spellcheck="false">{{ old('client.notes', $reservation->client->notes) }}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group required">
            <h4>Réservation</h4>
            <div class="form-check form-check-inline success">
                <input type="radio" id="reservation" name="reservation_type" value="reservation" {{ old('reservation_type', $reservation->reservation_type) === 'reservation' || empty($reservation->reservation_type) ? 'checked' : ''}}>
                <label for="reservation">
                    Réservation
                </label>
            </div>
            <div class="form-check form-check-inline primary">
                <input type="radio" id="pre_reservation" name="reservation_type" value="pre_reservation" {{ old('reservation_type', $reservation->reservation_type) === 'pre_reservation' ? 'checked' : ''}}>
                <label for="pre_reservation">
                    Pré-réservation
                </label>
            </div>
            <div class="form-check form-check-inline warning">
                <input type="radio" id="visit" name="reservation_type" value="visit" {{ old('reservation_type', $reservation->reservation_type) === 'visit' ? 'checked' : ''}}>
                <label for="visit">
                    Visite
                </label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group form-group-default">
            <label for="invoice_number">No de facture</label>
            <input type="text" id="invoice_number" name="invoice_number" value="{{ old('invoice_number', $reservation->invoice_number) }}" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <h5>Type de client</h5>
        <div class="form-group required">
            <div class="form-check form-check-inline success">
                <input type="radio" id="individual" name="type" value="individual" {{ old('type', $reservation->type) === 'individual' || empty($reservation->type) ? 'checked' : ''}}>
                <label for="individual">
                    Particulier
                </label>
            </div>
            <div class="form-check form-check-inline primary">
                <input type="radio" id="enterprise" name="type" value="enterprise" {{ old('type', $reservation->type) === 'enterprise' ? 'checked' : ''}}>
                <label for="enterprise">
                    Entreprise
                </label>
            </div>
            <div class="form-check form-check-inline warning">
                <input type="radio" id="eglise_espoir" name="type" value="eglise_espoir" {{ old('type', $reservation->type) === 'eglise_espoir' ? 'checked' : ''}}>
                <label for="eglise_espoir">
                    Église de l'Espoir
                </label>
            </div>
        </div>
    </div>
</div>
<h5>Date de l'appel</h5>
<div class="form-group-attached">
    <div class="row clearfix">
        <div class="col-md-4 col-lg-3">
            <div class="form-group form-group-default input-group date required" data-target-input="nearest" style="overflow: visible;">
                <div class="form-input-group">
                    <label for="call_date">Date de l'appel</label>
                    <input id="call_date" name="call_date" type="text" value="{{ old('call_date', $reservation->call_date ?? \Carbon\Carbon::now()->format('Y-m-d H:i')) }}" class="form-control datetimepicker-input"  data-target="#call_date" required>
                </div>
                <div class="input-group-append" data-target="#call_date" data-toggle="datetimepicker">
                    <span class="input-group-text"><i class="pg-icon">calendar</i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<h5>Date de l'activité</h5>
<div class="form-group-attached">
    <div class="row clearfix">
        <div class="col-md-4 col-lg-3">
            <div class="form-group form-group-default input-group required" style="overflow: visible;">
                <div class="form-input-group">
                    <label for="start_date">Date de début</label>
                    <input id="start_date" name="start_date" type="text" value="{{ old('start_date', $reservation->start_date) }}" class="form-control datetimepicker-input" required>
                </div>
                <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                    <span class="input-group-text"><i class="pg-icon">calendar</i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <div class="form-group form-group-default input-group required" style="overflow: visible;">
                <div class="form-input-group">
                    <label for="end_date">Date de fin</label>
                    <input id="end_date" name="end_date" type="text" value="{{ old('end_date', $reservation->end_date) }}" class="form-control datetimepicker-input" required>
                </div>
                <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                    <span class="input-group-text"><i class="pg-icon">calendar</i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group-attached">
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <div class="form-group form-group-default">
                <label for="guest_number">Nombre de personnes</label>
                <input type="text" id="guest_number" name="guest_number" value="{{ old('guest_number', $reservation->guest_number ?? 25) }}" class="form-control">
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="">
                <select class="cs-select cs-skin-slide" id="select_guest_number" data-init-plugin="cs-select">
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="80">80</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-3 col-6">
            <div class="form-group form-group-default form-check-group d-flex align-items-center">
                <div class="form-check switch switch-lg success full-width right m-b-0">
                    <input type="checkbox" id="liquor_license_needed" name="liquor_license_needed" value="1" {{ old('liquor_license_needed', $reservation->liquor_license_needed) ? 'checked' : '' }}>
                    <label for="liquor_license_needed">Permis d'alcool</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group required">
                <h5>Méthode de paiement</h5>
                <div class="form-check form-check-inline success">
                    <input type="radio" id="cash" name="payment_type" value="cash" {{ old('payment_type', $reservation->payment_type) === 'cash' || !$reservation->exists ? 'checked' : ''}}>
                    <label for="cash">
                        Comptant
                    </label>
                </div>
                <div class="form-check form-check-inline warning">
                    <input type="radio" id="interac" name="payment_type" value="interac" {{ old('payment_type', $reservation->payment_type) === 'interac' ? 'checked' : ''}}>
                    <label for="interac">
                        Interac
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-3 col-6">
            <div class="form-group form-group-default input-group required">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="pg-icon">$</i></span>
                </div>
                <div class="form-input-group">
                    <label for="price">Prix</label>
                    <input type="text" id="price" name="price" value="{{ old('price', $reservation->price) ?? 250 }}" data-m-dec="0" class="form-control autonumeric" required>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3 col-6">
            <div class="form-group form-group-default form-check-group d-flex align-items-center">
                <div class="form-check switch switch-lg success full-width right m-b-0">
                    <input type="checkbox" id="price_paid" name="price_paid" value="1" {{ old('price_paid', $reservation->price_paid) ? 'checked' : '' }}>
                    <label for="price_paid">Prix payé</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-3 col-6">
            <div class="form-group form-group-default input-group required">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="pg-icon">$</i></span>
                </div>
                <div class="form-input-group">
                    <label for="security_deposit">Dépot de sécurité</label>
                    <input type="text" id="security_deposit" name="security_deposit" value="{{ old('security_deposit', $reservation->security_deposit ?? 250) }}" data-m-dec="0" class="form-control autonumeric" required>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3 col-6">
            <div class="form-group form-group-default form-check-group d-flex align-items-center">
                <div class="form-check switch switch-lg success full-width right m-b-0">
                    <input type="checkbox" id="security_deposit_paid" name="security_deposit_paid" value="1" {{ old('security_deposit_paid', $reservation->security_deposit_paid) ? 'checked' : '' }}>
                    <label for="security_deposit_paid">Dépot de sécurité payé</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-3 col-6">
            <div class="form-group form-group-default input-group required">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="pg-icon">$</i></span>
                </div>
                <div class="form-input-group">
                    <label for="booking_fees">Frais d'ouverture de dossier</label>
                    <input type="text" id="booking_fees" name="booking_fees" value="{{ old('booking_fees', $reservation->booking_fees ?? 200) }}" data-m-dec="0" class="form-control autonumeric" required>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3 col-6">
            <div class="form-group form-group-default form-check-group d-flex align-items-center">
                <div class="form-check switch switch-lg success full-width right m-b-0">
                    <input type="checkbox" id="booking_fees_paid" name="booking_fees_paid" value="1" {{ old('booking_fees_paid', $reservation->booking_fees_paid) ? 'checked' : '' }}>
                    <label for="booking_fees_paid">Frais d'ouverture de dossier payé</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="notes" class="h6">Notes</label>
                <textarea id="notes" name="notes" class="form-control" rows="2" spellcheck="false">{{ old('notes', $reservation->notes) }}</textarea>
            </div>
        </div>
    </div>
</div>
