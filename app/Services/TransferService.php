<?php

namespace App\Services;

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

            $fromAccount = $this->repository
                ->find($data['from_account_id']);

            $toAccount = $this->repository
                ->find($data['to_account_id']);

            if ($fromAccount->balance < $data['amount']) {
                throw new \Exception('Insufficient balance');
            }

            $this->repository->decreaseBalance(
                $fromAccount,
                $data['amount']
            );

            $this->repository->increaseBalance(
                $toAccount,
                $data['amount']
            );

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
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}