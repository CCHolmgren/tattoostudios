@extends('layouts.app')

@section('content')
    <form action="{{ route('artist.update', $artist)  }}" method="post">
        {{ csrf_field() }}
        <div>
            <input type="text" name="name" placeholder="Name" value="{{ old('name', $artist->name) }}">
        </div>
        <div>
            <input type="text" name="style" placeholder="Style" value="{{ old('style', $artist->style) }}">
        </div>
        <div>
            <textarea name="description" id="" cols="30" rows="10" placeholder="Description">{{ old('description', $artist->description) }}</textarea>
        </div>
        <div>
            <input type="submit" value="Save artist">
        </div>
    </form>
@endsection