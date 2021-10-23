<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_type' => 'required|in:interac,cash',
            'reservation_type' => 'required|in:reservation,pre_reservation,visit',
            'type' => 'required',
            'invoice_number' => 'required_if:reservation_type,reservation',
            'security_deposit_paid' => 'boolean',
            'booking_fees_paid' => 'boolean',
            'price_paid' => 'boolean',
            'security_deposit' => 'required|numeric',
            'booking_fees' => 'required|numeric',
            'price' => 'required|numeric',
            'confirmation_sent' => 'boolean',
            'liquor_license_needed' => 'boolean',
            'call_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            //TODO: Array merge client rules
            'client.enterprise_name' => 'required_without:firstname,lastname',
            'client.rating' => 'required|in:accept,warning,block'
        ];
    }
}
