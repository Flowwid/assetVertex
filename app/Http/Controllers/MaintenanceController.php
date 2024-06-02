<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use App\Models\Bom;
use App\Models\Asset;
use App\Models\Division;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(){
        $maintenance = Maintenance::all();
        $bom = Bom::all();
        $asset = Asset::all();
        $division = Division::all();

        return view('maintenance', [
            'maintenance' => $maintenance,
            'bom' => $bom,
            'asset' => $asset,
            'division' => $division,
        ]);
    }

    public function insert(Request $request){
        $request->validate([
            'date' => 'required|date',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'asset_id' => 'required|integer|exists:asset,id',
            'asset_name' => 'required|string|max:255',
            'bom_id' => 'required|integer|exists:bom,id',
            'bom_serial' => 'required|string|max:255',
            'division_id' => 'required|integer|exists:division,id',
            'division_name' => 'required|string|max:255',
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;

            $path = 'uploads/maintenance/';
            $file->move($path, $filename);
        }

        Maintenance::create([
            'date' => $request->date,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $path.$filename,
            'asset_id' => $request->asset_id,
            'asset_name' => $request->asset_name,
            'bom_id' => $request->bom_id,
            'bom_serial' => $request->bom_serial,
            'division_id' => $request->division_id,
            'division_name' => $request->division_name,
        ]);
    
        return redirect(route('maintenance.index'));
    }

    public function update(Maintenance $maintenance_id, Request $request){
        $data = $request->validate([
            'status' => 'required|in:On-Repair,Repaired', // Validate only the status field
        ]);
    
        $maintenance_id->update($data);
    
        return redirect(route('maintenance.index'))->with('success', 'Maintenance status updated successfully');
    }
    

    public function delete(Maintenance $maintenance_id){
        $maintenance_id->delete();
        return redirect(route('maintenance.index'))->with('success', 'Maintenance Data is deleted');
    }

    public function getBomSerials(Request $request){
        $assetId = $request->input('asset_id');
        $boms = Bom::where('asset_id', $assetId)->get();

        return response()->json($boms);
    }

    
}
