<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index(){
        $budget = Budget::all();
        return view('budget', ['lists' => $budget]);
    }

    public function insert(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'year' => 'required',
            'nominal' => 'required',

        ]);

        $newBudget = Budget::create($data);

        return redirect(route('budget.index'));
    }
    
    public function edit($budget_id){
        $budget = Budget::findOrFail($budget_id);
        return view('edit', ['budget_id' => $budget]);
    }    

    public function update(Budget $budget_id, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'year' => 'required',
            'nominal' => 'required',
        ]);

        $budget_id->update($data);

        return redirect(route('budget.index'))->with('success', 'Product is updated');
    }
    
    public function delete(Budget $budget_id){
        $budget_id->delete();
        return redirect(route('budget.index'))->with('success', 'Product is deleted');
    }
}

