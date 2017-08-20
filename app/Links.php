<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $guarded = [];

    function linkable()
    {
        return $this->morphsTo();
    }
}
