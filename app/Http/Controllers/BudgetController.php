<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetCreate;
use App\Services\BudgetService;

class BudgetController extends Controller
{
    protected $budgetService;
    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }
    public function index()
    {
        $budgets = $this->budgetService->getAll();
        return Inertia('Budgets/Index', ['budgets' => $budgets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->budgetService->category();
        return Inertia('Budgets/Create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BudgetCreate $request)
    {
        $budget = $this->budgetService->create($request->all());
        return redirect()->route('budgets.show', $budget->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $budget = $this->budgetService->find($id);
        return Inertia('Budgets/Show', ['budget' => $budget]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $budget = $this->budgetService->find($id);
        $categories = $this->budgetService->category();
        return Inertia('Budgets/Edit', ['budget' => $budget, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BudgetCreate $request, $id)
    {
        $budget = $this->budgetService->find($id);
        $this->budgetService->update($id, $request->all());
        return redirect()->route('budgets.show', $budget->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $budget = $this->budgetService->find($id);
        $this->budgetService->delete($id);
        return redirect()->route('budgets.index');
    }
}
