<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    public function index(){
        $division = Division::all();
        return view('division', ['lists' => $division]);
    }

    public function insert(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $newProduct = Division::create($data);

        return redirect(route('division.index'));
    }

    public function edit($division_id){
        $division = Division::findOrFail($division_id);
        return view('edit', ['division_id' => $division]);
    }    

    public function update(division $division_id, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $division_id->update($data);

        return redirect(route('division.index'))->with('success', 'Product is updated');
    }
    
    public function delete(Division $division_id){
        $division_id->delete();
        return redirect(route('division.index'))->with('success', 'Product is deleted');
    }
}
