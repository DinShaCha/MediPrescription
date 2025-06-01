<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationSent extends Mailable
{
    use Queueable, SerializesModels;

    public $prescription;
    public $user;

    public function __construct($prescription, $user)
    {
        $this->prescription = $prescription;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Your Quotation is Ready')
                    ->markdown('emails.quotation');
    }
}