@extends('layouts.main')

@section('title', 'Creating a game')

@section('content')
    <h1 class="text-light">Creating a game</h1>

    <form action="/games/create" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
            <label class="text-light">Name</label>
            <input class="form-control" type="text" name="name" placeholder="Enter a name for the game">
            @if($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="text-light">Nickname</label>
            <input class="form-control" type="text" name="nickname" placeholder="Enter a nickname for the game, 5 characters maximum">
            @if($errors->has('nickname'))
                <p class="text-danger">{{ $errors->first('nickname') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="text-light">Genre</label>
            <select class="form-control" name="genre">
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection