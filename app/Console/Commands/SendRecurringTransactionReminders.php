<?php

namespace App\Console\Commands;

use App\Mail\RecurringTransactionReminderMail;
use App\Models\RecurringTransaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendRecurringTransactionReminders extends Command
{
     protected $signature = 'app:send-reminders';

    protected $description = 'Send reminder emails 3 days before recurring transaction';

    public function handle()
    {
        $recurrings = RecurringTransaction::whereDate(
            'next_run_date',
            now()->addDays(3)->toDateString()
        )->get();

        foreach ($recurrings as $recurring) {
            Mail::to($recurring->user->email)
                ->send(
                    new RecurringTransactionReminderMail(
                        $recurring
                    )
                );
        }

        $this->info('Reminder emails sent.');
    }
}
