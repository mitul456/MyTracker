<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ReportController extends Controller
{
    protected $reportService;

    public function __construct(TransactionService $reportService)
    {
        $this->reportService = $reportService;
    }
    public function index(Request $request)
    {
        $query = Transaction::with([
            'user',
            'account',
            'category'
        ]);

        if ($request->filled('start_date')) {
            $query->whereDate(
                'transaction_date',
                '>=',
                $request->start_date
            );
        }

        if ($request->filled('end_date')) {
            $query->whereDate(
                'transaction_date',
                '<=',
                $request->end_date
            );
        }

        if ($request->filled('account_id')) {
            $query->where(
                'account_id',
                $request->account_id
            );
        }

        if ($request->filled('category_id')) {
            $query->where(
                'category_id',
                $request->category_id
            );
        }

        if ($request->filled('type')) {
            $query->where(
                'type',
                $request->type
            );
        }

        if ($request->filled('search')) {
            $query->where(
                'note',
                'like',
                '%' . $request->search . '%'
            );
        }

        $transactions = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        $incomeExpenseChart = Transaction::selectRaw("
        DATE(transaction_date) as date,
        SUM(CASE WHEN type='income' THEN amount ELSE 0 END) as income,
        SUM(CASE WHEN type='expense' THEN amount ELSE 0 END) as expense
        ")
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $categoryBreakdown = Transaction::with('category')
        ->selectRaw('category_id,SUM(amount) as total')
        ->groupBy('category_id')
        ->get();

        $transactionTrend = Transaction::selectRaw("
            DATE(transaction_date) as date,
            SUM(amount) as total
        ")
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        return Inertia::render('Reports/Index', [
            'transactions' => $transactions,
            'accounts' => $this->reportService->getAccounts(),
            'categories' => $this->reportService->getCategories(),
            'incomeExpenseChart' => $incomeExpenseChart,
            'categoryBreakdown' => $categoryBreakdown,
            'transactionTrend' => $transactionTrend,

            'filters' => $request->only([
                'start_date',
                'end_date',
                'account_id',
                'category_id',
                'type',
                'search',
            ]),
        ]);
    }

    public function exportCsv()
    {
        return response()->json([
            'message' => 'Csv Export Coming Soon'
        ]);
    }

    public function exportExcel()
    {
        return response()->json([
            'message' => 'Excel Export Coming Soon'
        ]);
    }

    public function print()
    {
        return response()->json([
            'message' => 'Print Coming Soon'
        ]);
    }
}
