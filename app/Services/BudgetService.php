<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Transaction;
use App\Repositories\Contracts\BudgetRepositoryInterface;

class BudgetService
{
    protected BudgetRepositoryInterface $repository;

    public function __construct(BudgetRepositoryInterface $repository)
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
        $data['user_id'] = auth()->id();
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

    public function category()
    {
        $category = Category::where('user_id', auth()->user()->id)->latest()->get();
        return $category;
    }

    public function spentAmount($budget)
    {
        $spentAmount = Transaction::where('category_id', $budget->category_id)->where('type', 'expense')
            ->whereBetween('transaction_date', [
                $budget->start_date,
                $budget->end_date
            ])
            ->sum('amount');
        return $spentAmount;
    }
}