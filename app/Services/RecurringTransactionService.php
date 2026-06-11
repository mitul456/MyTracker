<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Category;
use App\Repositories\Contracts\RecurringTransactionRepositoryInterface;

class RecurringTransactionService
{
    protected RecurringTransactionRepositoryInterface $repository;

    public function __construct(RecurringTransactionRepositoryInterface $repository)
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
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function accounts()
    {
        return Account::where('user_id', auth()->id())->latest()->get();
    }

    public function categories()
    {
        return Category::where('user_id', auth()->id())->latest()->get();
    }
}