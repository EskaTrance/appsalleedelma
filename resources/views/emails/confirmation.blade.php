

<table>
    @if($reservation->invoice_number)
        <tr>
            <td><strong>Numéro de facture:</strong> {{ $reservation->invoice_number }}</td>
            <td></td>
        </tr>
    @endif
    <tr>
        <td><strong>Début de l'activité:</strong> {{ $reservation->start_date->isoFormat('LLLL') }}</td>
        <td></td>
    </tr>
    <tr>
        <td><strong>Fin de l'activité:</strong> {{ $reservation->end_date->isoFormat('LLLL') }}</td>
        <td></td>
    </tr>
</table>
<br/>
<table>
    @if(!empty($reservation->client->enterprise_name))
        <tr>
            <td><strong>Nom de l'entreprise:</strong> {{ $reservation->client->enterprise_name }}</td>
            <td></td>
        </tr>
    @endif
    <tr>
        <td><strong>Prénom:</strong> {{ $reservation->client->firstname }}</td>
        <td><strong>Nom de famille: {{ $reservation->client->lastname }}</td>
    </tr>
    <tr>
        <td><strong>Téléphone:</strong> {{ $reservation->client->telephone }}</td>
        <td><strong>Courriel:</strong> {{ $reservation->client->email }}</td>
    </tr>
    <tr>
        <td><strong>Nombre de personnes:</strong> {{ $reservation->guest_number }}</td>
        <td><strong>Permis d'alcool:</strong> {{ $reservation->liquor_license_needed ? 'Oui' : 'Non' }}</td>
    </tr>
</table>
<table>
    <tr>
        <td><strong>Frais d'ouverture de dossier:</strong></td>
        <td>{{ (int)$reservation->booking_fees }}$ - {{ $reservation->booking_fees_paid ? 'Payé' : 'Non-payé' }}</td>
    </tr>
    <tr>
        <td><strong>Prix:</strong></td>
        <td>{{ (int)$reservation->price }}$ - {{ $reservation->price_paid ? 'Payé' : 'Non-payé' }}</td>
    </tr>
    <tr>
        <td><strong>Total:</strong></td>
        <td>{{ (int)$reservation->booking_fees + $reservation->price }}$</td>
    </tr>
    <tr style="border-top: 2px solid #000000">
        <td><strong>Dépot de sécurité:</strong></td>
        <td>{{ (int)$reservation->security_deposit }}$ - {{ $reservation->security_deposit_paid ? 'Payé' : 'Non-payé' }}</td>
    </tr>
</table>
@if($reservation->liquor_license_needed)
    <p>Le permis d'alcool vous sera remis à la signature.</p>
@endif
<p>Ceci n'est pas le contrat, le contrat sera signé sur place.</p>
<p style="color: #f35958; font-weight: bold">Attention: Vous êtes dans l'obligation de respecter les règlements sanitaires du gouvernement et de le faire respecter à vos invités.</p>
<p style="color: #f35958; font-weight: bold">Attention: Dans le cas que les règlements ne soient pas respectés, nous pouvons mettre fin à tout moment à l'activité si nous nous apercevons nous-mêmes du non-respect.</p>
<p style="color: #f35958; font-weight: bold">Attention: Toute sanction financière du non-respect sera à vos frais.</p>
