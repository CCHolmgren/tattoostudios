<?php

namespace App\Http\Controllers;

use App\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    function store()
    {
        Studio::create(
            request()->only(
                'name',
                'description',
                'style',
                'location'
            )
        );

        return redirect()->route('home');
    }

    function show($studio)
    {
        $studio = Studio::find($studio);

        $studio->views()->create([
            'request_info' => json_encode([
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]),
            'user_id' => request()->user() ? request()->user()->id : null
        ]);

        return view('studio.show', [
            'studio' => $studio
        ]);
    }

    function create()
    {
        return view('studio.create');
    }

    function edit($studio)
    {
        $studio = Studio::find($studio);

        return view('studio.edit', [
            'studio' => $studio
        ]);
    }

    function update($studio)
    {
        $studio = Studio::find($studio);

        $studio->fill(request()->all())->save();

        return redirect()->route('studio.show', $studio);
    }

    function associateWithArtist($studio)
    {
        Studio::find($studio)->artists()->syncWithoutDetaching([request('artist_id') => [
            'status' => request('status'),
            'start' => request('start'),
            'end' => request('end')
        ]]);

        return redirect()->route('studio.show', $studio);
    }

    function removeAssociationWithArtist($studio)
    {
        Studio::find($studio)->artists()->detach(request('artist_id'));

        return redirect()->route('studio.show', $studio);
    }
}
