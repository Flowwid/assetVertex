<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Fund;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
    $events = Event::all();

    $nominals = [];

    $totalUsed = Fund::selectRaw('event_id, SUM(used) as nominal')->groupBy('event_id')->get();
    foreach ($totalUsed as $totalNominal) {
        $nominals[$totalNominal->event_id] = $totalNominal->nominal;
    }

    foreach ($events as $event) {
        $event->nominal = $nominals[$event->id] ?? 0;
        $event->save();
    }

    return view('event', ['lists' => $events]);
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
