<?php

namespace App\Repositories;


use App\Models\Account;
use App\Models\Transfer;
use App\Repositories\Contracts\TransferRepositoryInterface;

class TransferRepository implements TransferRepositoryInterface
{
    public function all()
    {
        $transfer = Transfer::where('user_id', auth()->id())->with(['fromAccount', 'toAccount', 'user.profile'])->get();
        return $transfer;
    }
    public function find($id)
    {
        $transfer = Transfer::where('user_id', auth()->id())->with(['fromAccount', 'toAccount'])->findOrFail($id);
        return $transfer;
    }
    public function create(array $data)
    {
        $transfer = Transfer::create($data);
        return $transfer;
    }
    public function update($id, array $data)
    {
        $transfer = $this->find($id);
        $transfer->update($data);
        return $transfer;
    }
    public function delete($id)
    {
        $transfer = $this->find($id);
        $transfer->delete();
        return true;
    }

    public function accounts()
    {
        $accounts = Account::where('user_id', auth()->id())->get();
        return $accounts;
    }
}