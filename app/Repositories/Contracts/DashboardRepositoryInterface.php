<?php

namespace App\Repositories\Contracts;

interface DashboardRepositoryInterface
{
    public function totalIncome();
    public function totalExpenses();
    public function netBalance();

    public function getBudgetSummary();

    public function accounts();

    public function transactions();
    
}