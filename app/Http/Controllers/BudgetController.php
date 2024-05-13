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
}
