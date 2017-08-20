<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistStudio extends Model
{
    protected $guarded = [];

    function artist()
    {
        return $this->hasOne(Artist::class);
    }

    function studio()
    {
        return $this->hasOne(Studio::class);
    }
}
