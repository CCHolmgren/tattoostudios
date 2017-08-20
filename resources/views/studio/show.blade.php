@extends('layouts.app')

@section('content')
    <img src="/img/studio.jpg" alt="" class="object-cover h-400 w-max">
    <div>
        <h1 style="font-size: 4rem; margin: 0">{{ $studio->name }} <a style="font-size: 1rem;"
                                                                      href="{{ route('studio.edit', $studio) }}">Edit</a>
        </h1>
        <h2>{{ $studio->formattedLocation }}</h2>
        <p>{{ $studio->style }}</p>
        <p style="text-align: left; white-space: pre;">{{ $studio->formattedDescription }}</p>
    </div>

    <h2>Artists</h2>
    <form action="{{ route('studio.artists.associate', $studio) }}" method="post">
        {{ csrf_field() }}
        <div>
            <select name="artist_id" id="">
                @foreach(\App\Artist::all() as $artist)
                    <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <input type="radio" name="status" value="1"> Permanent
            <input type="radio" name="status" value="2"> Temporary
        </div>
        <div>
            <input type="text" name="start"> Start
            <input type="text" name="end"> End
        </div>
        <div>
            <input type="submit" value="Associate">
        </div>
    </form>
    @foreach($studio->artists as $artist)
        <div>
            <img src="/img/artist-medium.jpg" alt="" height="48" width="72">
            <a href="{{ route('artist.show', $artist) }}" style="text-decoration: none;">
                <span style="font-size: 1.5rem">{{ $artist->name }}</span>
                <span>
                    {{ $artist->pivot->status == 1 ? 'Permanent' : 'Temporary' }}
                    @if($artist->pivot->start)Start: {{ carbon($artist->pivot->start)->format('l jS \\of F Y') }}@endif
                    @if($artist->pivot->end)End: {{ carbon($artist->pivot->start)->format('l jS \\of F Y') }}@endif
                </span>
            </a>
            <form action="{{ route('studio.artists.detach', $studio) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="artist_id" value="{{ $artist->id }}">
                <input type="submit" value="Detach">
            </form>
        </div>
    @endforeach
    <h2>Links</h2>
    <form action="{{ route('artist.links.store', $artist) }}" method="post">
        {{ csrf_field() }}
        <div>
            <input type="text" name="content" placeholder="Content">
        </div>
        <div>
            <input type="radio" name="type" value="instagram"> Instagram
            <input type="radio" name="type" value="facebook"> Facebook
            <input type="radio" name="type" value="website"> Website
        </div>
        <input type="submit" value="Save link">
    </form>
    @foreach($studio->links as $link)
        <div>
            @if($link->type == "instagram")
                <a href="https://instagram.com/{{ $link->content }}">@{{ $link }}</a>
            @endif
        </div>
    @endforeach

    <h2>Views</h2>
    {{ $studio->views()->count() }}
@endsection