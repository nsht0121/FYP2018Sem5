<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\EventCategory;
use App\EventClass;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Auth;

class EventController extends BaseController
{

    public function getAll()
    {
        $data = Event::where('is_hidden', 0)
            ->orderBy('created_at', 'desc')
            ->with('eventCategories')
            ->paginate(10);

        foreach($data as $d) {
            $d->setHidden(['imagepath']);
            $d->description = preg_replace('~[\r\n]+~', '', strip_tags($d->description));
            $d->description = str_replace(array( '\xC2\xA0', '&nbsp;' ), ' ', $d->description);
            $d->description = preg_replace('!\s+!', ' ', strip_tags($d->description));
            $d->description = mb_substr($d->description, 0, 100, 'UTF-8') . '...';
            $d->description = trim($d->description);
            $d->thumbnail = asset($d->thumbnail);
        }

        return $this->sendResponse($data);
    }

    public function getBySlug($slug)
    {
        $data = Event::where('slug', $slug)->get();
        $data->imagepath = asset($d->imagepath);

        if($data->isEmpty()) {
            return $this->sendError("Event not found.");
        } else {
            return $this->sendResponse($data);
        }
    }

    public function getByCategory($category) {
        $data = EventCategory::where('slug', $category)->first();

        if(!$data) {
            return $this->sendError("Category not found.");
        } else {
            $data = $data->events()->orderBy('updated_at', 'desc')->paginate(5);
            $data->makeHidden('content');
        }

        if($data->isEmpty()) {
            return $this->sendError("Event not found.");
        } else {
            return $this->sendResponse($data);
        }
    }

    /**
     * Join or Leave Event
     * event slug | class id
     */
    public function joinEvent($slug, $id) {
        $userId = Auth::id();

        if ($userId) {
            $class = EventClass::findOrFail($id);
            
            // check joined or not
            $user = $class->users()->find($userId);
            if ($user) {
                $class->users()->detach($userId);
                $message = "Event left.";
            } else {
                // check quota
                if ($class->quota > 0) {
                    if ($class->quota > $class->users()->count()) {
                        $class->users()->attach($userId);
                        $message = "Event joined.";
                    } else {
                        $message = "No Slot.";
                    }
                } else {
                    $class->users()->attach($userId);
                    $message = "Event joined.";
                }
            }
        } else {
            $message = "Please Login First";
        }

        return $this->sendResponse(null, $message);
    }

    public function sayHello() {
        $user = Auth::user()->name;
        return $this->sendResponse(null, "Hello ".$user);
    }

}
