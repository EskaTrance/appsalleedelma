<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', [
            'reservations' => $reservations
        ]);
    }

    public function calendar()
    {
        return view('reservations.calendar');
    }

    public function getReservations(Request $request)
    {
        $reservations = Reservation::all();
        $reservationsForCalendar = [];
        foreach ($reservations as $reservation) {

            $reservationsForCalendar[] = [
                'id' => $reservation->id,
                'text' => trim($reservation->client->enterprise_name . ' ' . $reservation->client->firstname . ' ' . $reservation->client->lastname),
                'start_date' => $reservation->start_date,
                'end_date' => $reservation->end_date
            ];
        }

        return $reservationsForCalendar;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reservation = new Reservation();
        $reservation->client = new Client();
        return view('reservations.create')->with('reservation', $reservation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ReservationRequest  $request
     */
    public function store(ReservationRequest $request)
    {
        if (empty($request->get('client_id'))) {
            $client = Client::create($request->get('client'));
        } else {
            $client = new Client();
            $client->update($request->get('client'));
        }

        $reservation = new Reservation();
        $reservation->price_paid = $request->has('price_paid');
        $reservation->security_deposit_paid = $request->has('security_deposit_paid');
        $reservation->booking_fees_paid = $request->has('booking_fees_paid');
        $reservation->liquor_license_needed = $request->has('liquor_license_needed');
        $reservation->confirmation_sent = $request->has('confirmation_sent');
        $reservation->client_id = $client->id;
        $reservation->fill($request->all());
        $reservation->save();
//        Reservation::create('')

//        $reservation->update($request->all());
//        $client = Client::findOrFail($request['client']['id']);
//        $client->update($request->get('client'));
////        $client->save();
//        $request->session()->flash('success', 'La réservation à été sauvegardé');
////        return view('reservations.edit')->with('reservation', $reservation);
//        return back()->with('success', 'La réservation à été sauvegardé');
        return redirect()->route('reservations.edit', compact('reservation'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        return view('reservations.edit')->with('reservation', $reservation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
//        $clientRequest = new ClientRequest;
//        $request->validate($clientRequest->rules(), $request->get('client'));
        $reservation->price_paid = $request->has('price_paid');
        $reservation->security_deposit_paid = $request->has('security_deposit_paid');
        $reservation->booking_fees_paid = $request->has('booking_fees_paid');
        $reservation->liquor_license_needed = $request->has('liquor_license_needed');
        $reservation->confirmation_sent = $request->has('confirmation_sent');

        if (empty($request->get('client_id'))) {
            $client = Client::create($request->get('client'));
        } else {
            $client = Client::findOrFail($request['client']['id']);
            $client->update($request->get('client'));
        }
        $reservation->client_id = $client->id;
        $reservation->update($request->all());

//        $client->save();
        $request->session()->flash('success', 'La réservation à été sauvegardé');
//        return view('reservations.edit')->with('reservation', $reservation);
        return back()->with('success', 'La réservation à été sauvegardé');
//        $reservation->client()->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     */
    public function destroy(Reservation $reservation)
    {
        $client = $reservation->client;
        $reservation->delete();
        if ($client->reservations) {
            $client->delete();
        }
        return redirect()->route('reservations.calendar')->with('success', 'La réservation à été supprimé');
    }
}
