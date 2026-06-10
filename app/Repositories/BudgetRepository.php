<?php

namespace App\Repositories;

use App\Models\Budget;
use App\Repositories\Contracts\BudgetRepositoryInterface;

class BudgetRepository implements BudgetRepositoryInterface
{
    public function all(){
        return Budget::where('user_id', auth()->id())->with('category')->latest()->get();
    }
    public function find($id){
        return Budget::where('user_id', auth()->id())->with('category')->findOrFail($id);
    }
    public function create(array $data){
        return Budget::create($data);
    }
    public function update($id, array $data){
        $budget = $this->find($id);
        $budget->update($data);
        return $budget;
    }
    public function delete($id){
        $budget = $this->find($id);
        $budget->delete();
    }
}