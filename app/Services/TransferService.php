<?php

namespace App\Services;

use App\Models\Account;
use App\Repositories\Contracts\TransferRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TransferService
{
    protected TransferRepositoryInterface $repository;

    public function __construct(TransferRepositoryInterface $repository)
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
        $userId = auth()->id();
        return DB::transaction(function () use ($userId, $data) {

            $fromAccount = Account::findOrFail($data['from_account_id']);
            $toAccount = Account::findOrFail($data['to_account_id']);

            if ($data['from_account_id'] == $data['to_account_id']) {
                throw new \Exception('Source and destination accounts cannot be the same');
            }

            if ($data['amount'] <= 0) {
                throw new \Exception('Invalid amount');
            }

            if ($fromAccount->balance < $data['amount']) {
                throw new \Exception('Insufficient balance');
            }

            $fromAccount->decrement('balance', $data['amount']);
            $toAccount->increment('balance', $data['amount']);

            return $this->repository->create([
                'user_id' => $userId,
                'from_account_id' => $data['from_account_id'],
                'to_account_id' => $data['to_account_id'],
                'amount' => $data['amount'],
                'transfer_date' => $data['transfer_date'],
            ]);
        });
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {

            $transfer = $this->repository->find($id);

            $oldFrom = $this->repository->find($transfer->from_account_id);
            $oldTo = $this->repository->find($transfer->to_account_id);

            // Rollback old transfer
            $oldFrom->increment('balance', $transfer->amount);
            $oldTo->decrement('balance', $transfer->amount);

            $newFrom = $this->repository->find($data['from_account_id']);
            $newTo = $this->repository->find($data['to_account_id']);

            if ($newFrom->balance < $data['amount']) {
                throw new \Exception('Insufficient balance');
            }

            // Apply new transfer
            $newFrom->decrement('balance', $data['amount']);
            $newTo->increment('balance', $data['amount']);

            return $this->repository->update($id, $data);
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {

            $transfer = $this->repository->find($id);

            $fromAccount = $this->repository->find(
                $transfer->from_account_id
            );

            $toAccount = $this->repository->find(
                $transfer->to_account_id
            );

            // Reverse transfer
            $fromAccount->increment('balance', $transfer->amount);
            $toAccount->decrement('balance', $transfer->amount);

            return $this->repository->delete($id);
        });
    }

    public function accounts()
    {
        return $this->repository->accounts();
    }
}
