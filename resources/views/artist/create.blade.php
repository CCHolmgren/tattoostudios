@extends('layouts.app')

@section('content')
    <form action="{{ route('artist.store')  }}" method="post">
        {{ csrf_field() }}
        <div>
            <input type="text" name="name" placeholder="Name">
        </div>
        <div>
            <input type="text" name="style" placeholder="Style">
        </div>
        <div>
            <textarea name="description" id="" cols="30" rows="10" placeholder="Description"></textarea>
        </div>
        <div>
            <input type="submit" value="Save artist">
        </div>
    </form>
@endsection