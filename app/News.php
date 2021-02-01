<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'thumbnail', 'imagepath', 'is_hidden',
    ];

    public function newsCategories() {
        return $this->belongsToMany(NewsCategory::class);
    }
}
