<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Budget;
use App\Models\Transaction;
use App\Repositories\Contracts\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function totalIncome(){
        return Transaction::where('user_id', auth()->id())->where('type', 'income')->sum('amount');
    }
    public function totalExpenses(){
        return Transaction::where('user_id', auth()->id())->where('type', 'expense')->sum('amount');
    }
    public function netBalance(){
        return $this->totalIncome() - $this->totalExpenses();
    }

    public function getBudgetSummary(){
        return Budget::where('user_id', auth()->id())->with('category')->get();
    }

    public function accounts(){
        return Account::where('user_id', auth()->id())->latest()->take(4)->get();
    }

    public function transactions(){
        return Transaction::where('user_id', auth()->id())->with(['category', 'account'])->latest()->take(5)->get();
    }

}