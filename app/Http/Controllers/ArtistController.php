<?php

namespace App\Http\Controllers;

use App\Artist;
use App\ArtistStudio;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    function show($artist)
    {
        $artist = Artist::find($artist);

        $artist->views()->create([
            'request_info' => json_encode([
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]),
            'user_id' => request()->user() ? request()->user()->id : null
        ]);

        return view('artist.show', [
            'artist' => $artist
        ]);
    }

    function store()
    {
        $artist = Artist::create(
            request()->only(
                'name',
                'style'
            )
        );

        return redirect()->route('artist.show', $artist);
    }

    function create()
    {
        return view('artist.create');
    }

    function edit($artist)
    {
        $artist = Artist::find($artist);

        return view('artist.edit', [
            'artist' => $artist
        ]);
    }

    function update($artist)
    {
        $artist = Artist::find($artist);
        $artist->fill(request()->all())->save();

        return redirect()->route('artist.show', $artist);
    }

    function associateWithStudio($artist)
    {
        Artist::find($artist)->studios()->syncWithoutDetaching([request('studio_id') => [
            'status' => request('status'),
            'start' => request('start'),
            'end' => request('end')
        ]]);

        return redirect()->route('artist.show', $artist);
    }

    function removeAssociationWithStudio($artist)
    {
        Artist::find($artist)->studios()->detach(request('studio_id'));

        return redirect()->route('artist.show', $artist);
    }
}
