<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Studio;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    function storeForArtist($artist)
    {
        Artist::find($artist)->links()->create(request()->all());

        return redirect()->route('artist.show', $artist);
    }

    function storeForStudio($studio)
    {
        Studio::find($studio)->links()->create(request()->all());

        return redirect()->route('studio.show', $studio);
    }
}
