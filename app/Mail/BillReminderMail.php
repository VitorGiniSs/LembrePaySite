<?php

namespace App\Mail;

use App\Models\Bill;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Bill $bill
    ) {}

    public function build()
    {
        return $this->subject('Lembrete de vencimento - LembrePay')
            ->view('emails.bill-reminder');
    }
}