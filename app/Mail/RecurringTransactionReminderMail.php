<?php

namespace App\Mail;

use App\Models\RecurringTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecurringTransactionReminderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $recurring;

    public function __construct(RecurringTransaction $recurring)
    {
        $this->recurring = $recurring;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Upcoming Recurring Transaction Reminder',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.recurring-reminder',
        );
    }
}