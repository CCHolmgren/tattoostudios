@extends('layouts.app')

@section('content')
    <img src="/img/artist.jpg" alt="" class="object-cover h-400 w-max">
    <div class="text-center">
        <h1 style="font-size: 4rem; margin: 0;">{{ $artist->name }} <a style="font-size: 1rem;" href="{{ route('artist.edit', $artist) }}">Edit</a></h1>
        <span>{{ $artist->style }}</span>
        <p style="white-space: pre;">{{ $artist->formattedDescription }}</p>
    </div>

    <h2>Studios</h2>
    <form action="{{ route('artist.studios.associate', $artist) }}" method="post">
        {{ csrf_field() }}
        <div>
            <select name="studio_id" id="">
                @foreach(\App\Studio::all() as $studio)
                    <option value="{{ $studio->id }}">{{ $studio->name }}</option>
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
    @foreach($artist->studios as $studio)
        <div>
            <a href="{{ route('studio.show', $studio) }}" style="text-decoration: none;">
                <img src="/img/studio-medium.jpg" alt="" height="48" width="72" class="block">
                <span style="vertical-align: top; font-size: 1.5rem">{{ $studio->name }}</span>
                <span>{{ $studio->pivot->status == 1 ? 'Permanent' : 'Temporary' }}
                    @if($studio->pivot->start)Start: {{ carbon($studio->pivot->start)->format('l jS \\of F Y') }}@endif
                    @if($studio->pivot->end)End: {{ carbon($studio->pivot->start)->format('l jS \\of F Y') }}@endif
                </span>
                {{ $studio->location }}
            </a>
            <form action="{{ route('artist.studios.detach', $artist) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="studio_id" value="{{ $studio->id }}">
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
    @foreach($artist->links as $link)
        <div>
            @if($link->type == "instagram")
                Instagram: <a href="https://instagram.com/{{ $link->content }}">{{ '@' . $link->content }}</a>
            @endif
        </div>
    @endforeach

    <h2>Views</h2>
    {{ $artist->views()->count() }}
@endsection