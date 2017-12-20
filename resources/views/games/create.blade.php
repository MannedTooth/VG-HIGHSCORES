@extends('layouts.main')

@section('title', 'Creating a game')

@section('content')
    <h1 class="text-light">Creating a game</h1>

    <form action="/games/create" method="POST" enctype="multipart/form-data">
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
            <label class="text-light">Short description</label>
            <input class="form-control" type="text" name="description" placeholder="Ex.: Kill monsters, earn money, save the princess. Repeat.">
            @if($errors->has('description'))
                <p class="text-danger">{{ $errors->first('description') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label class="text-light">Year of release</label>
            <input class="form-control" type="number" min="1900" max="2100" name="release_year">
            @if($errors->has('release_year'))
                <p class="text-danger">{{ $errors->first('release_year') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label class="text-light">Genres</label><br>
            <div class="container">
                <div class="row">
                    @foreach($genres as $genre)
                        <div class="col">
                            <label class="form-check-label text-light">
                                <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}"> {{ $genre->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="text-light">Image</label>
            <input class="form-control" type="file" name="image">
            @if($errors->has('image'))
                <p class="text-danger">{{ $errors->first('image') }}</p>
            @endif
        </div>

        <button class="btn btn-primary" type="submit">Create</button>
    </form>
@endsection