<?php

namespace App\Http\Controllers;

use DB;
use App\Event;
use App\EventCategory;
use App\EventClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    private function slug($id, $title)
    {
        $cleanText = "";
        $cleanText = preg_replace('![-?]+!', ' ', trim($title));
        $cleanText = preg_replace('!\s+!', ' ', trim($cleanText));
        return $id . '-' . preg_replace('/[\\\\\/\s]+/u', '-', trim($cleanText));
    }

    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')
            ->paginate(10);

        foreach($events as $e) {
            $e->description = preg_replace('~[\r\n]+~', '', strip_tags($e->description));
            $e->description = str_replace(array( '\xC2\xA0', '&nbsp;' ), ' ', $e->description);
            $e->description = preg_replace('!\s+!', ' ', strip_tags($e->description));
            $e->description = mb_substr($e->description, 0, 150, 'UTF-8') . '...';
            $e->description = trim($e->description);
        }

        return view('backend.events.index', ['events' => $events]);
    }

    public function create()
    {
        $categories = EventCategory::get()
            ->pluck('name', 'id');
        
        return view('backend.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|max:191',
            'fee' => 'numeric|min:0|max:9999',
            'quota' => 'numeric|min:0|max:9999',
        ]);

        // Checkbox value
        $request->request->add([
            'is_hidden' => $request->has('is_hidden'),
            'is_canceled' => $request->has('is_canceled'),
        ]);

        // Store item
        $event = Event::create($request->all());

        // Attach category to pivot table if input categories[] is not empty
        if(!empty($request->categories)) {
            $event->eventCategories()
                ->attach($request->categories);
        }

        // Image
        if($request->has('image')) {
            $ext = $request->file('image')->extension();

            // store image
            $path = $request->file('image')->store('images');
            $event->imagepath = Storage::url($path);

            // store thumbnail
            $path = $request->file('image')->store('thumb');
            $event->thumbnail = Storage::url($path);

            $thumb = Image::make(public_path($event->thumbnail))
                ->fit(320, 240, function($constraint) {
                    $constraint->upsize();
                });
            $thumb->save();
        }

        // Make slug
        $event->slug = $this->slug($event->id, $event->title);
        $event->save();

        // Create new class
        $class = new EventClass;
        $class->name = $event->title;
        $event->eventClasses()->save($class);

        return redirect()->route('backend.events.index');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('backend.events.show', ['event' => $event, 'categories' => $event->eventCategories]);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = EventCategory::get()
            ->pluck('name', 'id');

        return view('backend.events.edit', compact('categories'), ['event' => $event, 'selectedCategories' => $event->eventCategories]);
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'title' => 'required|max:191',
            'fee' => 'numeric|min:0|max:9999',
            'quota' => 'numeric|min:0|max:9999',
        ]);

        // Update new item
        $event = Event::findOrFail($id);
        $event->slug = $this->slug($id, $request->title);
        $event->is_hidden = $request->has('is_hidden');
        $event->is_canceled = $request->has('is_canceled');
        $event->update($request->all());

        // Attach/detach category to/from pivot table
        if(!empty($request->categories)) {
            $event->eventCategories()
                ->sync($request->categories);
        } else {
            $event->eventCategories()
                ->detach();
        }

        return redirect()->route('backend.events.index');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('backend.events.index');
    }

    public function joinEvent($eslug, $cid) {
        $userId = Auth::id();

        if ($userId) {
            $class = EventClass::findOrFail($cid);
            
            // check joined or not
            $user = $class->users()->find($userId);
            if ($user) {
                $class->users()->detach($userId);
            } else {
                // check quota
                if ($class->quota > 0) {
                    if ($class->quota > $class->users()->count()) {
                        $class->users()->attach($userId);
                    } else {
                        return "No Slot";
                    }
                } else {
                    $class->users()->attach($userId);
                }
            }
        } else {
            return redirect()->route('login');
        }

        return redirect()->route('site.event_detail', $eslug);
    }

}
