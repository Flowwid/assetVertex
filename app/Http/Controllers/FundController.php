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

}
