<?php

namespace App\Services;

use App\Repositories\Contracts\DashboardRepositoryInterface;

class DashboardService
{
    protected $repository;

    public function __construct(DashboardRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function totalIncome(){
        return $this->repository->totalIncome();
    }
    public function totalExpenses(){
        return $this->repository->totalExpenses();
    }
    public function netBalance(){
        return $this->repository->netBalance();
    }

    public function getBudgetSummary(){
        return $this->repository->getBudgetSummary();
    }

    public function accounts(){
        return $this->repository->accounts();
    }

    public function transactions(){
        return $this->repository->transactions();
    }
}