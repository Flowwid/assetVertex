<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(){
        $maintenance = Maintenance::all();
        return view('maintenance', ['lists' => $maintenance]);
    }
}
