<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountCreate;
use App\Models\Account;
use App\Services\AccountService;
use Inertia\Inertia;

class AccountController extends Controller
{
    protected $accountService;
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }
    public function index()
    {
        $accounts = $this->accountService->getAll();
        $totalNetWorth = $this->accountService->totalNetWorth();
        return Inertia::render('Accounts/Index', [
            'accounts' => $accounts,
            'totalNetWorth' => $totalNetWorth
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Accounts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountCreate $request)
    {
        $accounts =$request->validated();
        $this->accountService->create($accounts);
        return redirect()->route('accounts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        $account = $this->accountService->find($account->id);
        return Inertia::render('Accounts/Show', ['account' => $account]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        $account = $this->accountService->find($account->id);
        return Inertia::render('Accounts/Edit', ['account' => $account]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountCreate $request, $id)
    {
        $accounts = $request->validated();
        $this->accountService->update($id, $accounts);
        return redirect()->route('accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->accountService->delete($id);
        return redirect()->route('accounts.index');
    }
}
