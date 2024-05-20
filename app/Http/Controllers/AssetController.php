<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AssetExport;

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

    public function import(Request $request){
    $file = $request->file('file');
    $fileHandle = fopen($file->getPathname(), 'r');

    // Skip the header row
    fgetcsv($fileHandle);

    while (($data = fgetcsv($fileHandle)) !== false) {
        // Trim whitespace and semicolons from each field
        $name = trim($data[0], ";\t\n\r\0\x0B");
        $type = trim($data[1], ";\t\n\r\0\x0B");
        $specification = trim($data[2], ";\t\n\r\0\x0B");

        Asset::create([
            'name' => $name,
            'type' => $type,
            'specification' => $specification,
        ]);
    }

        fclose($fileHandle);

        return redirect(route('asset.index'));
    }

    public function export() 
    {
        return Excel::download(new AssetExport, 'Asset.xlsx');
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
