<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function all()
    {
        $transactions = Transaction::where('user_id', auth()->id())->with(['account', 'category', 'user.profile'])->latest()->paginate(5);
        return $transactions;
    }

    public function find($id)
    {
        $transaction = Transaction::where('user_id', auth()->id())->with(['account', 'category'])->findOrFail($id);
        return $transaction;
    }

    public function create(array $data)
    {
        return Transaction::create($data);
    }

    public function update($id, array $data)
    {
        $transaction = $this->find($id);
        if ($transaction) {
            $transaction->update($data);
            return $transaction;
        }
        return null;
    }

    public function delete($id)
    {
        $transaction = $this->find($id);
        if ($transaction) {
            $transaction->delete();
            return true;
        }
        return false;
    }

    public function getAccounts()
    {
        return auth()->user()->accounts()->get();
    }

    public function getCategories()
    {
        return auth()->user()->categories()->get();
    }
}

