<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Transfer;
use App\Repositories\Contracts\TransferRepositoryInterface;

class TransferRepository implements TransferRepositoryInterface
{
    public function all()
    {
        $transfer = Transfer::where('user_id', auth()->id())->get();
        return $transfer;
    }
    public function find($id)
    {
        $transfer = Transfer::where('user_id', auth()->id())->findOrFail($id);
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
}