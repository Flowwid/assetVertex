<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use App\Models\Budget;
use App\Models\Event;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function index($budget_id) {
        $budgets = Budget::findOrFail($budget_id);
        $events = Event::all();
        $funds = $budgets->fund;
        
        return view('fund', [
            'budgets' => $budgets,
            'events' => $events,
            'funds' => $funds
        ]);
    }

    public function insert(Request $request, $budget_id) {
    $request->validate([
        'used' => 'required|numeric|min:0',
        'event_id' => 'required|integer',
        'event_name' => 'required|string',
    ]);

    $budgets = Budget::findOrFail($budget_id);

    $totalUsed = Fund::where('budget_id', $budget_id)->sum('used');

    if (($totalUsed + $request->used) > $budgets->nominal) {
        return redirect()->back()->withErrors(['used' => 'The total used amount exceeds the available budget.'])
                             ->with('alert', 'The total used amount exceeds the available budget.')
                             ->withInput();
    }

    $data = new Fund();
    $data->used = $request->used;
    $data->event_id = $request->event_id;
    $data->event_name = $request->event_name;
    $data->budget_id = $budgets->id;
    $data->budget_name = $budgets->name;

    $data->save();

    return redirect(route('fund.index', $budget_id));
}


    public function edit($budget_id, $fund_id) {
        $budget = Budget::findOrFail($budget_id);
        $events = Event::all();
        $fund = Fund::findOrFail($fund_id);
        return view('edit', [
            'budget_id' => $budget,
            'events' => $events,
            'fund_id' => $fund,
        ]);
    }

    public function update(Request $request, $budget_id, $fund_id) {
        $budget = Budget::findOrFail($budget_id);
        $fund = Fund::findOrFail($fund_id);

        $data = $request->validate([
            'used' => 'required',
            'event_id' => 'required',
            'event_name' => 'required',
        ]);

        $fund->update($data);

        return redirect(route('fund.index', $budget_id))->with('success', 'Fund updated successfully');
    }

    public function delete($budget_id, $fund_id) {
        $fund = Fund::findOrFail($fund_id);
        $fund->delete();
    
        return redirect(route('fund.index', $budget_id))->with('success', 'Fund is deleted');
    }    

}
