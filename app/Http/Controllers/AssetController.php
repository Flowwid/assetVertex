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

    public function insert(Request $request){
        $data = $request->validate([
            'name' => 'required', 
            'type' => 'required',
            'specification' => 'required',
        ]);

        $newProduct = Asset::create($data);

        return redirect(route('asset.index'));
    }

    public function edit($asset_id){
        $asset = Asset::findOrFail($asset_id);
        return view('edit', ['asset_id' => $asset]);
    }    

    public function update(asset $asset_id, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'specification' => 'required',
        ]);

        $asset_id->update($data);

        return redirect(route('asset.index'))->with('success', 'Asset is updated');
    }
    

    public function delete(Asset $asset_id){
        $asset_id->delete();
        return redirect(route('asset.index'))->with('success', 'Asset is deleted');
    }

}
