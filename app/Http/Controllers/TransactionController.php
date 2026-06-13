<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use Inertia\Inertia;

class TransactionController extends Controller
{
    protected $transaction;
    public function __construct(TransactionService $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index()
    {
        $transactions = $this->transaction->getAll();
        return Inertia::render('Transactions/Index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Transactions/Create', [
            'accounts' => $this->transaction->getAccounts(),
            'categories' => $this->transaction->getCategories(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->validated();
        $this->transaction->create($data);
        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaction = $this->transaction->find($id);
        return Inertia::render('Transactions/Show', ['transaction' => $transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transaction = $this->transaction->find($id);

        return Inertia::render('Transactions/Edit', [
            'transaction' => $transaction,
            'accounts' => $this->transaction->getAccounts(),
            'categories' => $this->transaction->getCategories(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, $id)
    {
        $data = $request->validated();
        $this->transaction->update($id, $data);
        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->transaction->delete($id);
        return redirect()->route('transactions.index');
    }
}
