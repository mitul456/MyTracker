<?php

namespace App\Repositories;

use App\Models\RecurringTransaction;
use App\Repositories\Contracts\RecurringTransactionRepositoryInterface;

class RecurringTransactionRepository implements RecurringTransactionRepositoryInterface
{
    public function all(){
        $recurringTransactions = RecurringTransaction::where('user_id', auth()->id())->with(['account', 'category', 'user.profile'])->latest()->get();
        return $recurringTransactions;
    }
    public function find($id){
        $recurringTransaction = RecurringTransaction::where('user_id', auth()->id())->with(['account', 'category'])->findOrFail($id);
        return $recurringTransaction;
    }
    public function create(array $data){
        $data['user_id'] = auth()->id();
        return RecurringTransaction::create($data);
    }
    public function update($id, array $data){
        $recurringTransaction = $this->find($id);
        $recurringTransaction->update($data);
        return $recurringTransaction;
    }
    public function delete($id){
        $recurringTransaction = $this->find($id);
        return $recurringTransaction->delete();
    }
}