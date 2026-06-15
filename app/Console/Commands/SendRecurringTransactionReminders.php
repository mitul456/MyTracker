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
        RecurringTransaction::with('user')
            ->whereBetween('next_run_date', [
                now()->addDays(3)->startOfDay(),
                now()->addDays(3)->endOfDay(),
            ])
            ->chunk(100, function ($recurrings) {

                $recurrings->groupBy('user_id')->each(function ($items) {
                    $user = $items->first()->user;

                    if (!$user?->email)
                        return;

                    foreach ($items as $recurring) {
                        Mail::to($user->email)->queue(
                            new RecurringTransactionReminderMail($recurring)
                        );
                    }
                });
            });

        $this->info('Reminder emails sent.');
    }
}
