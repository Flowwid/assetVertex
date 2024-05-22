<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Fund;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $totalUsed = Fund::selectRaw('event_id, SUM(used) as nominal')->groupBy('event_id')->get();

        foreach ($totalUsed as $totalNominal) {
            Event::where('id', $totalNominal->event_id)->update(['nominal' => $totalNominal->nominal]);
        }

        $event = Event::all();

        return view('event', ['lists' => $event]);
    }

    public function insert(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'year' => 'required',
            'implementation' => 'required',
            'nominal' => 'nullable',
        ]);

        $data['nominal'] = $request->input('nominal', 0);

        $newProduct = Event::create($data);

        return redirect(route('event.index'));
    }

    public function edit($event_id){
        $event = Event::findOrFail($event_id);
        return view('edit', ['event_id' => $event]);
    }

    public function update(event $event_id, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'year' => 'required',
            'implementation' => 'required',
        ]);

        $event_id->update($data);

        return redirect(route('event.index'))->with('success', 'Event is updated');
    }

    public function delete(Event $event_id){
        $event_id->delete();
        return redirect(route('event.index'))->with('success', 'Event is deleted');
    }
}
