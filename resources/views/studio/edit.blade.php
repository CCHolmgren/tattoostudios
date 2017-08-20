@extends('layouts.app')

@section('content')
    <form action="{{ route('studio.update', $studio) }}" method="post">
        {{ csrf_field() }}
        <div>
            <input type="text" name="name" placeholder="Name" value="{{ old('name', $studio->name) }}">
        </div>
        <div>
            <input type="text" name="location" placeholder="Location" value="{{ old('location', $studio->location) }}">
        </div>
        <div>
            <input type="text" name="style" placeholder="Style" value="{{ old('style', $studio->style) }}">
        </div>
        <div>
            <textarea name="description" id="" cols="30" rows="10" placeholder="Description">{{ old('description', $studio->description) }}</textarea>
        </div>
        <div>
            <input type="submit" value="Save studio">
        </div>
    </form>
@endsection