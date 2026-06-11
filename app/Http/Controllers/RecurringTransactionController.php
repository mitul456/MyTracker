<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecurringTR;
use App\Services\RecurringTransactionService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecurringTransactionController extends Controller
{
    protected $recurringTrxService;

    public function __construct(RecurringTransactionService $recurringTrxService)
    {
        $this->recurringTrxService = $recurringTrxService;
    }

    public function index()
    {
        $recurringTransactions = $this->recurringTrxService->getAll();
        
        return Inertia::render('RecurringTransactions/Index', [
            'recurringTransactions' => $recurringTransactions,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accounts = $this->recurringTrxService->accounts();
        $categories = $this->recurringTrxService->categories();
        return Inertia::render('RecurringTransactions/Create', [
            'accounts' => $accounts,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecurringTR $request)
    {
        $data = $request->validated();
        $this->recurringTrxService->create($data);

        return redirect()->route('recurring-transactions.index')->with('success', 'Recurring Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $recurringTransaction = $this->recurringTrxService->find($id);
        

        return Inertia::render('RecurringTransactions/Show', [
            'recurringTransaction' => $recurringTransaction,
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $recurringTransaction = $this->recurringTrxService->find($id);
        $accounts = $this->recurringTrxService->accounts();
        $categories = $this->recurringTrxService->categories();
        return Inertia::render('RecurringTransactions/Edit', [
            'recurringTransaction' => $recurringTransaction,
            'accounts' => $accounts,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecurringTR $request, $id)
    {
        $data = $request->validated();
        
        $this->recurringTrxService->update($id, $data);
        return redirect()->route('recurring-transactions.index')->with('success', 'Recurring Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->recurringTrxService->delete($id);
        return redirect()->route('recurring-transactions.index')->with('success', 'Recurring Transaction deleted successfully.');
    }
}
