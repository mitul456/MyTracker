<?php

namespace App\Mail;

use App\Models\RecurringTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecurringTransactionReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $recurring;

    public function __construct(RecurringTransaction $recurring)
    {
        $this->recurring = $recurring;
    }

    public function build()
    {
        return $this
            ->subject('Upcoming Recurring Transaction Reminder')
            ->view('Mail.recurring-reminder');
    }
}
