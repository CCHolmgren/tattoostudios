@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <a href="{{ route('studio.create') }}">New Studio</a>
                        <a href="{{ route('artist.create') }}">New Artist</a>
                        @foreach(\App\Studio::all() as $studio)
                            <div class="text-center mw-720">
                                <a href="{{ route('studio.show', $studio) }}">
                                    <div class="negative-margin-lr">
                                        <img src="/img/studio-medium.jpg" alt="" height="480" width="720" class="block">
                                    </div>
                                    <div style="font-size: 2rem;">{{ $studio->name }}</div>
                                </a>
                            </div>
                        @endforeach
                        @foreach(\App\Artist::all() as $artist)
                            <div class="text-center mw-720">
                                <a href="{{ route('artist.show', $artist) }}">
                                    <div>
                                        <img src="/img/artist-medium.jpg" alt="" height="480" width="720" class="block">
                                    </div>
                                    <div style="font-size: 2rem;">{{ $artist->name }}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
