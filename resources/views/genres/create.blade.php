@extends('layouts.main')

@section('title', 'Creating a genre')

@section('content')
    <h1>Creating a genre</h1>

    <form action="/genres/create" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
            <label>Nom</label>
            <input class="form-control" type="text" name="name" placeholder="Enter a name for the genre">
        </div>
        <button type="submit">Create</button>
    </form>
@endsection