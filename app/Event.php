<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'venue', 'fee',
        'apply_start', 'apply_end', 'event_start', 'event_end',
        'thumbnail', 'imagepath', 'is_hidden', 'is_canceled',
    ];

    public function eventCategories() {
        return $this->belongsToMany(EventCategory::class);
    }

    public function eventClasses() {
        return $this->hasMany(EventClass::class);
    }
}
