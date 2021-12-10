<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Confirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->reservation->reservation_type === 'reservation') {
            $subject = 'Confirmation de la Réservation';
        } else {
            $subject = 'Confirmation de la Pré-réservation';
        }
        return $this->view('emails.confirmation')
            ->subject('Salle Edelma - ' . $subject)
            ->bcc('ccarriere01@gmail.com')
            ->attach('assets/reglements-salle-edelma.pdf');
    }
}
