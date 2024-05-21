<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Bom;
use Illuminate\Http\Request;

class BomController extends Controller
{
    public function index($asset_id) {
        $assets = Asset::findOrFail($asset_id);
        $boms = $assets->bom;
        
        return view('bom', [
            'assets' => $assets,
            'boms' => $boms
        ]);
    }

    public function insert(Request $request, $asset_id) {
        $assets = Asset::findOrFail($asset_id);

        $data = new Bom();
        $data->serial = $request->serial;
        $data->condition = $request->condition;
        $data->status = $request->status;
        $data->note = $request->note;

        $data->asset_id = $assets->id;
        $data->asset_name = $assets->name;

        $data->save();

        return redirect(route('bom.index', $asset_id));
    }

    public function edit($asset_id, $bom_id) {
        $asset = Asset::findOrFail($asset_id);
        $bom = Bom::findOrFail($bom_id);
        return view('edit', [
            'asset$asset_id' => $asset,
            'bom_id' => $bom,
        ]);
    }

    public function update(Request $request, $asset_id, $bom_id) {
        $asset = Asset::findOrFail($asset_id);
        $bom = Bom::findOrFail($bom_id);

        $data = $request->validate([
            'serial' => 'required',
            'condition' => 'required',
            'status' => 'required',
            'note' => 'required',
        ]);

        $bom->update($data);

        return redirect(route('bom.index', $asset_id))->with('success', 'Bom updated successfully');
    }

    public function delete($asset_id, $bom_id) {
        $bom = Bom::findOrFail($bom_id);
        $bom->delete();
    
        return redirect(route('bom.index', $asset_id))->with('success', 'Asset is deleted');
    }
}
