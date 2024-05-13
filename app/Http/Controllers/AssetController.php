<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(){
        $asset = Asset::all();
        return view('asset', ['lists' => $asset]);
    }
}
