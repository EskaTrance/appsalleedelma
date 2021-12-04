<table>
    <tr>
        <td>Nom de l'entreprise: {{ $reservation->client->enterprise_name }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Prénom: {{ $reservation->client->firstname }}</td>
        <td>Nom de famille: {{ $reservation->client->lastname }}</td>
    </tr>
    <tr>
        <td>Téléphone: {{ $reservation->client->telephone }}</td>
        <td>Courriel: {{ $reservation->client->email }}</td>
    </tr>
    <tr>
        <td>Début de l'activité: {{ $reservation->start_date->isoFormat('LLLL') }}</td>
        <td>Fin de l'activité: {{ $reservation->end_date->isoFormat('LLLL') }}</td>
    </tr>
    <tr>
        <td>Nombre de personnes: {{ $reservation->guest_number }}</td>
        <td>Permis d'alcool: {{ $reservation->liquor_license_needed ? 'Oui' : 'Non' }}</td>
    </tr>
    <tr>
        <td>Frais d'ouverture de dossier: {{ $reservation->booking_fees }}$ - {{ $reservation->booking_fees_paid ? 'Payé' : 'Non-payé' }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Prix: {{ $reservation->price }}$ - {{ $reservation->price_paid ? 'Payé' : 'Non-payé' }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Dépot de sécurité: {{ $reservation->security_deposit }}$ - {{ $reservation->security_deposit_paid ? 'Payé' : 'Non-payé' }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Total: {{ $reservation->booking_fees + $reservation->price }}$</td>
        <td></td>
    </tr>
</table>
<p style="color: #f35958; font-weight: bold">Attention: Vous êtes dans l'obligation de respecter les règlements sanitaires du gouvernement et de le faire respecter à vos invités.</p>
<p style="color: #f35958; font-weight: bold">Attention: Dans le cas que les règlements ne soient pas respectés, nous pouvons mettre fin à tout moment à l'activité si nous nous apercevons nous-mêmes du non-respect.</p>
<p style="color: #f35958; font-weight: bold">Attention: Toute sanction financière du non-respect sera à vos frais.</p>
