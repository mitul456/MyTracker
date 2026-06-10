<?php

namespace App\Services;

use App\Models\Account;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    protected TransactionRepositoryInterface $repository;

    public function __construct(TransactionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        DB::transaction(function () use ($data) {

            $data['user_id'] = auth()->id();

            $account = Account::findOrFail($data['account_id']);

            if ($data['type'] == 'expense') {
                $account->decrement('balance', $data['amount']);
            } else {
                $account->increment('balance', $data['amount']);
            }


            return $this->repository->create($data);
        });
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {

            $transaction = $this->repository->find($id);

            $account = Account::findOrFail($transaction->account_id);

            if ($transaction->type == 'expense') {
                $account->increment('balance', $transaction->amount);
            } else {
                $account->decrement('balance', $transaction->amount);
            }

            return $this->repository->delete($id);
        });
    }

    public function getAccounts()
    {
        return $this->repository->getAccounts();
    }

    public function getCategories()
    {
        return $this->repository->getCategories();
    }
}