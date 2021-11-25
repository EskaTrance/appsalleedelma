<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reservation
 *
 * @property int $id
 * @property string $payment_type
 * @property string $type
 * @property string $reservation_type
 * @property string $booking_fees
 * @property int $booking_fees_paid
 * @property string $price
 * @property int $price_paid
 * @property string $security_deposit
 * @property \Illuminate\Support\Carbon|null $security_deposit_paid_date
 * @property \Illuminate\Support\Carbon|null $security_deposit_return_date
 * @property int|null $guest_number
 * @property string|null $notes
 * @property int $client_id
 * @property string|null $invoice_number
 * @property int $confirmation_sent
 * @property int $liquor_license_needed
 * @property \Illuminate\Support\Carbon $call_date
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereBookingFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereBookingFeesPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCallDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereConfirmationSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereGuestNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereLiquorLicenseNeeded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePricePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereReservationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereSecurityDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereSecurityDepositPaidDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereSecurityDepositReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $repeating_reservation_id
 * @property-read \App\Models\RepeatingReservations $repeatingReservations
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereRepeatingReservationId($value)
 */
class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'repeating_reservation_id',
        'invoice_number',
        'payment_type',
        'reservation_type',
        'type',
        'security_deposit_paid',
        'booking_fees_paid',
        'price_paid',
        'security_deposit',
        'security_deposit_paid_date',
        'security_deposit_return_date',
        'booking_fees',
        'price',
        'guest_number',
        'liquor_license_needed',
        'confirmation_sent',
        'call_date',
        'start_date',
        'end_date',
        'notes',
    ];
    protected $casts = [
        'security_deposit_paid_date' => 'datetime',
        'security_deposit_return_date' => 'datetime',
        'call_date' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];
    protected $with = ['client', 'repeatingReservation'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function repeatingReservation()
    {
        return $this->belongsTo(RepeatingReservations::class);
    }
}
