<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $guarded = [];

    function studios()
    {
        return $this->belongsToMany(Studio::class, 'artist_studios')->withPivot('status', 'start', 'end')->withTimestamps();
    }

    function links()
    {
        return $this->morphMany(Links::class, 'linkable');
    }

    function views()
    {
        return $this->morphMany(PageView::class, 'viewable');
    }

    function getFormattedDescriptionAttribute()
    {
        return $this->description;
    }
}
