<?php

namespace App\Repositories;

use App\Models\Account;
use App\Repositories\Contracts\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    public function all()
    {
        return Account::where('user_id', auth()->id())->with(['user.profile'])->latest()->paginate(6);
    }

    public function find($id)
    {
        return Account::where('user_id', auth()->id())->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->id();
        return Account::create($data);
    }

    public function update($id, array $data)
    {
        $account = $this->find($id);
        $account->update($data);
        return $account;
    }

    public function delete($id)
    {
        $account = $this->find($id);
        $account->delete();
    }


    public function increaseBalance(Account $account, float $amount)
    {
        $account->increment('balance', $amount);
    }

    public function decreaseBalance(Account $account, float $amount)
    {
        $account->decrement('balance', $amount);
    }

    public function totalNetWorth()
    {
        $accounts = Account::where('user_id', auth()->id())->get();
        $totalNetWorth = $accounts->sum('balance');
        return $totalNetWorth;
    }
}