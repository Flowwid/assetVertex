<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Budget;
use App\Models\Event;

class DashboardController extends Controller
{
    public function chart()
    {
        $assets = Asset::withCount('bom')->get(['name', 'bom_count']);
        $budgets = Budget::all(['year', 'nominal']);
        $events = Event::all(['name', 'year', 'nominal']);

        return view('dashboard', [
            'assets' => $assets,
            'budgets' => $budgets,
            'events' => $events
        ]);
    }
}
