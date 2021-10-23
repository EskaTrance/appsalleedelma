<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'invoice_number',
        'payment_type',
        'reservation_type',
        'type',
        'security_deposit_paid',
        'booking_fees_paid',
        'price_paid',
        'security_deposit',
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

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
