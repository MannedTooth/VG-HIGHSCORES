@extends('layouts.main')

@section('title', 'Editing a game')

@section('content')
    <h1 class="text-light">Editing a game : {{ $game->name }}</h1>

    <form action="/games/edit/{{ $game->nickname }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <input type="hidden" name="id" value="{{ $game->id }}">
        <div class="form-group">
            <label class="text-light">Name</label>
            <input class="form-control" type="text" name="name" value="{{ $game->name }}">
            @if($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="text-light">Nickname</label>
            <input class="form-control" type="text" name="nickname" value="{{ $game->nickname }}">
            @if($errors->has('nickname'))
                <p class="text-danger">{{ $errors->first('nickname') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="text-light">Genre</label>
            @if ($game->genres()->count() > 0)
                <select class="form-control" name="genre">
                    @foreach ($genres as $genre)
                            @if ($genre->id == $game->genres()->first()->id)
                                <option value="{{ $genre->id }}" selected>{{ $genre->name }}</option>
                            @else
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endif
                    @endforeach
                </select>
            @endif
        </div>
        <button type="submit">Create</button>
    </form>
@endsection