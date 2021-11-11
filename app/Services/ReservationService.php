<?php


namespace App\Services;


use App\Models\RepeatingReservations;
use App\Models\Reservation;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\MessageBag;

class ReservationService
{
    public function getRepeatingReservationsDates(RepeatingReservations $repeatingReservations, Reservation $reservation): CarbonPeriod
    {
        $weekDay = $repeatingReservations->repeat_weekday;
        $period = CarbonPeriod::between($repeatingReservations->repeat_start, $repeatingReservations->repeat_end->endOfDay())->addFilter(function (Carbon $date) use ($reservation, $weekDay) {
            if ($reservation->exists && $date->toDate() == $reservation->start_date->toDate()) {
                return false;
            }
            return $date->isoWeekday() == $weekDay;
        });

        return $period;
    }

    public function getAvailablesRepeatingReservationsDates(RepeatingReservations $repeatingReservations, Reservation $reservation)
    {
        $repeatingReservationsDates = $this->getRepeatingReservationsDates($repeatingReservations, $reservation);
        $reservations = $this->getReservationsByDates($repeatingReservationsDates, $reservation);
        $filter = function (Carbon $date, $reservations) {

        };
        $repeatingReservationsDates->addFilter($filter);

    }

    public function getReservationsByDates(CarbonPeriod $startPeriod, Reservation $reservation)
    {
        $reservationDuration = $reservation->start_date->diffInMinutes($reservation->end_date);
        return Reservation::where('id', '!=', $reservation->id)->where(function ($query) use ($startPeriod, $reservationDuration) {
            foreach ($startPeriod as $startDate) {
                $query->orWhere(function ($q) use ($startDate, $reservationDuration) {
                    $endDate = $startDate->copy()->addMinutes($reservationDuration);
                    $q->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate]);
                });
            }
        })->get();
    }

    public function validateRepeatingReservations(RepeatingReservations $repeatingReservations, Reservation $reservation): MessageBag
    {
        $reservations = $this->getReservationsByDates($this->getRepeatingReservationsDates($repeatingReservations, $reservation), $reservation);
        $errors = new MessageBag();
        if ($reservations) {
            foreach ($reservations as $conflictReservation) {
                $errors->add('repeating_conflict_reservation', 'Une réservation existe déjà de '. $conflictReservation->client->getClientName() . ' entre ' . $conflictReservation->start_date . ' et ' . $conflictReservation->end_date);
            }

        }

        return $errors;
    }

    /**
     * @param Reservation $reservation
     */
    public function validateDateAvailable(Reservation $reservation)
    {
        $conflictReservation = Reservation::where('id', '!=', $reservation->id)->where(function ($query) use ($reservation) {
            $query->whereBetween('start_date', [$reservation->start_date, $reservation->end_date])
                ->orWhereBetween('end_date', [$reservation->start_date, $reservation->end_date]);
        })->first();
        return $conflictReservation;
    }
}
