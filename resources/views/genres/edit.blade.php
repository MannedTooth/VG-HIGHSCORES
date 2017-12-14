@extends('layouts.main')

@section('title', 'Editing a genre')

@section('content')
    <h1>Editing genre : {{$genre->name}}</h1>

    <form action="/genres/edit/{{ $genre->id }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <input type="hidden" name="id" value="{{ $genre->id }}">
        <div class="form-group">
            <label>Genre</label>
            <input class="form-control" type="text" name="name" value="{{ $genre->name }}">
        </div>
        <button type="submit">Edit</button>
    </form>
@endsection