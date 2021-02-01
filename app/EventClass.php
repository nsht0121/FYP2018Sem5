<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventClass extends Model
{
    protected $fillable = [
        'name', 'quota', 'event_id',
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
