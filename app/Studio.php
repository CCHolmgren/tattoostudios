<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $guarded = [];

    function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_studios')->withPivot('status', 'start', 'end')->withTimestamps();
    }

    function links()
    {
        return $this->morphMany(Links::class, 'linkable');
    }

    function views()
    {
        return $this->morphMany(PageView::class, 'viewable');
    }

    function getFormattedLocationAttribute()
    {
        try {
            $location = json_decode($this->location);
        } catch(\Exception $e) {
            $location = [];
        }

        return object_get($location, 'address') . ", " . object_get($location, 'city') . " " . object_get($location, "country");
    }

    function getFormattedDescriptionAttribute()
    {
        return $this->description;
    }
}
