<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    public function index()
    {
        $totalIncome = $this->dashboardService->totalIncome();
        $totalExpenses = $this->dashboardService->totalExpenses();
        $netBalance = $this->dashboardService->netBalance();
        $budgets = $this->dashboardService->getBudgetSummary();
        $accounts = $this->dashboardService->accounts();
        $transactions = $this->dashboardService->transactions();

        return Inertia::render('Dashboard/Dashboard', [
            'totalIncome' => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'netBalance' => $netBalance,
            'budgets' => $budgets,
            'accounts' => $accounts,
            'transactions' => $transactions
        ]);
    }


}
