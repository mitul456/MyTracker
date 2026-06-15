<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\RecurringTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessRecurringTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process recurring transactions that are due today';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $recurrings = RecurringTransaction::whereDate(
            'next_run_date',
            '<=',
            today()
        )->get();

        foreach ($recurrings as $recurring) {

            Transaction::create([
                'user_id' => $recurring->user_id,
                'account_id' => $recurring->account_id,
                'category_id' => $recurring->category_id,
                'amount' => $recurring->amount,
                'type' => $recurring->type,
                'note' => 'Recurring Transaction',
                'transaction_date' => today()
            ]);

            $account = Account::where('user_id', $recurring->user_id)->findOrFail($recurring->account_id);

            if($recurring->type == 'expense') {
                    $account->decrement('balance', $recurring->amount);
            } else {
                $account->increment('balance', $recurring->amount);
            }

            // Update next_run_date based on frequency
            $nextDate = Carbon::parse(
                $recurring->next_run_date
            );

            switch ($recurring->frequency) {
                case 'daily':
                    $nextDate->addDay();
                    break;
                case 'weekly':
                    $nextDate->addWeek();
                    break;
                case 'monthly':
                    $nextDate->addMonth();
                    break;
                case 'yearly':
                    $nextDate->addYear();
                    break;
            }

            $recurring->update([
                'next_run_date' => $nextDate
            ]);
        }

        $this->info('Recurring transactions processed.');
    }
}
