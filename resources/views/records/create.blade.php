@extends('layouts.main')

@section('title', 'Creating a record')

@section('content')
    <h1 class="text-light">Creating a record for {{ $game->name }}</h1>

    <form action="/games/{{ $game->nickname }}/records/create" method="POST">
        {{ csrf_field() }}

        <input type="hidden" name="game_id" value="{{ $game->id }}">
        <div class="form-group">
            <label class="text-light">Name</label>
            <input class="form-control" type="text" name="name" placeholder="Furthest distance, smallest/biggest number of, etc.">
            @if($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="text-light">Unit</label>
            <input class="form-control" type="text" name="unit" placeholder="Points, goals, stars, etc.">
            @if($errors->has('unit'))
                <p class="text-danger">{{ $errors->first('unit') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="text-light">Timed record?</label>
            <input type="checkbox" class="form-control" name="time">
        </div>
        <div class="form-group">
            <label class="text-light">Decreasing score?</label>
            <input type="checkbox" class="form-control" name="decreasing">
        </div>
        <button type="submit">Create</button>
    </form>
@endsection