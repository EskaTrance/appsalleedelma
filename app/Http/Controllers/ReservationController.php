<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\RepeatingReservations;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use App\Services\ReservationService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;
use Response;
use Validator;

class ReservationController extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

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
                'text' => trim($reservation->client->enterprise_name . ' ' . $reservation->client->firstname . ' ' . $reservation->client->lastname . ' ' . $reservation->client->telephone),
                'reservation_type' => $reservation->reservation_type,
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
     * Show the form for creating a new resource.
     */
    public function createxhr()
    {
        $reservation = new Reservation();
        $reservation->client = new Client();
        return view('reservations.createxhr')->with('reservation', $reservation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ReservationRequest  $request
     */
    public function store(ReservationRequest $request, Reservation $reservation)
    {
        $reservation->fill($request->all());
        $reservation->booking_fees_paid = $request->has('booking_fees_paid');
        $reservation->price_paid = $request->has('price_paid');
        $reservation->liquor_license_needed = $request->has('liquor_license_needed');
        $reservation->confirmation_sent = $request->has('confirmation_sent');


        if ($request->get('activate_recurrence')) {
            $repeatingReservations = new RepeatingReservations();
            $repeatingReservations->fill($request->get('repeating_reservations'));
            $repeatingReservations->repeat_start = $reservation->start_date->toDate();
            $repeatingReservations->repeat_weekday = $reservation->start_date->isoWeekday();

            $repeatingErrors = $this->reservationService->validateRepeatingReservations($repeatingReservations, $reservation);
            if ($repeatingErrors->count()) {
                return back()->withInput()->withErrors($repeatingErrors);
            }

            $repeatingReservations->save();
            $reservation->repeating_reservation_id = $repeatingReservations->id;
        }

        $conflictReservation = $this->reservationService->validateDateAvailable($reservation);
        if ($conflictReservation) {
            $errors = new MessageBag();
            $errors->add('date_availability', 'Une réservation existe déjà de '. $conflictReservation->client->getClientName() . ' entre ' . $conflictReservation->start_date . ' et ' . $conflictReservation->end_date);
            return back()->withInput()->withErrors($errors);
        }

        if (empty($request->get('client_id'))) {
            $client = Client::create($request->get('client'));
        } else {
            $client = Client::findOrFail($request['client']['id']);
            $client->update($request->get('client'));
        }
        $reservation->client_id = $client->id;
        $reservation->save();

        if ($request->get('activate_recurrence')) {
            $reservationStartDates = $this->reservationService->getRepeatingReservationsDates($repeatingReservations, $reservation);
            $reservationDuration = $reservation->start_date->diffInMinutes($reservation->end_date);
            foreach ($reservationStartDates as $reservationStartDate) {
                $reservationEndDate = $reservationStartDate->copy()->addMinutes($reservationDuration);
                $newReservation = $reservation->replicate();
                $newReservation->start_date = $reservationStartDate;
                $newReservation->end_date = $reservationEndDate;
                if ($newReservation->reservation_type === 'reservation') {
                    $newReservation->invoice_number = $reservationStartDate->format('Ymd') . 'A';
                }
                $newReservation->save();
            }
        }

        $request->session()->flash('success', 'La réservation à été sauvegardé');
        if ($request->ajax()) {
            $reservation->client = $client;
            $reservation->client->label = $reservation->client->getLabel();
            return Response::json($reservation->toArray());
        }
        return redirect()->route('reservations.edit', compact('reservation'));
    }

    /**
     * @param  \App\Models\Reservation  $reservation
     */
    public function edit(Reservation $reservation)
    {
        return view('reservations.edit')->with('reservation', $reservation);
    }
    /**
     * @param  \App\Models\Reservation  $reservation
     */
    public function editxhr(Reservation $reservation)
    {
        return view('reservations.editxhr')->with('reservation', $reservation);
    }

    /**
     *
     * @param  ReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        $reservation->fill($request->all());
        $reservation->price_paid = $request->has('price_paid');
        $reservation->booking_fees_paid = $request->has('booking_fees_paid');
        $reservation->liquor_license_needed = $request->has('liquor_license_needed');
        $reservation->confirmation_sent = $request->has('confirmation_sent');

        $conflictReservation = $this->reservationService->validateDateAvailable($reservation);
        if ($conflictReservation) {
            $errors = new MessageBag();
            $errors->add('date_availability', 'Une réservation existe déjà de '. $conflictReservation->client->getClientName() . ' entre ' . $conflictReservation->start_date . ' et ' . $conflictReservation->end_date);
            return back()->withInput()->withErrors($errors);
        }

        if (empty($request->get('client_id'))) {
            $client = Client::create($request->get('client'));
        } else {
            $client = Client::findOrFail($request['client']['id']);
            $client->update($request->get('client'));
        }
        $reservation->client_id = $client->id;
        $reservation->save();

        session()->flash('success', 'La réservation à été sauvegardé');
//        return view('reservations.edit')->with('reservation', $reservation);
        return back()->with('success', 'La réservation à été sauvegardé');
    }

    public function repeatingEvents(Reservation $reservation)
    {
        $reservationDuration = $reservation->start_date->diffInMinutes($reservation->end_date);
        $weekDay = 1;
        $repeatStart = Carbon::now();
        $repeatEnd = Carbon::now()->addDays(30);
        $period = CarbonPeriod::between($repeatStart, $repeatEnd);
        $dates = [];
        foreach ($period as $periodDate) {
            if ($periodDate->weekday() == $weekDay) {
                $startDate = $periodDate->setTime($reservation->start_date->hour, $reservation->start_date->minute);
                $dates[] = [
                    'start_date' => $startDate,
                    'end_date' => $startDate->addMinutes($reservationDuration),
                ];
            }
        }

        $conflictReservations = Reservation::where('id', '!=', $reservation->id)->where(function ($query) use ($dates) {
            foreach ($dates as $date) {
                $query->whereBetween('start_date', [$date['start_date'], $date['end_date']])
                    ->orWhereBetween('end_date', [$date['start_date'], $date['end_date']]);
            }
        })->get();
        return $conflictReservations;
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
        if (!$client->reservations) {
            $client->delete();
        }
        return redirect()->route('reservations.calendar')->with('success', 'La réservation à été supprimé');
    }
}
