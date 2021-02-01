<?php

namespace App\Http\Controllers;

use App\EventClass;
use Illuminate\Http\Request;

class EventClassController extends Controller
{
    public function index()
    {
        abort(404);
    }

    public function create(Request $request)
    {
        return view('backend.event_classes.create', ['eventId' => $request->query('eventId')]);
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|max:191',
            'quota' => 'numeric|min:0|max:9999',
            'event_id' => 'required',
        ]);

        // Create new class
        $class = EventClass::create($request->all());

        return redirect()->route('backend.events.show', $request->event_id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $class = EventClass::findOrFail($id);

        return view('backend.event_classes.edit', ['class' => $class]);
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'name' => 'required|max:191',
            'quota' => 'numeric|min:0|max:9999',
            'event_id' => 'required',
        ]);

        // Update class
        $class = EventClass::findOrFail($id);
        $class->update($request->all());

        return redirect()->route('backend.events.show', $request->event_id);
    }

    public function destroy($id)
    {
        $class = EventClass::findOrFail($id);
        $eventId = $class->event_id;
        $class->delete();

        return redirect()->route('backend.events.show', $eventId);
    }
}
