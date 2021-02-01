<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $fillable = [
        'name', 'slug',
    ];

    public function events() {
        return $this->belongsToMany(Event::class);
    }
}
