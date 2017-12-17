@extends('layouts.main')

@section('title', 'Creating an attempt')

@section('content')
    <h1 class="text-light">Creating an attempt for {{ $record->name }}</h1>

    <form action="/games/{{ $record->game->nickname }}/records/{{ $record->id }}/attempts/create" method="POST">
        {{ csrf_field() }}

        <input type="hidden" name="record_id" value="{{ $record->id }}">
        <div class="form-group">
            <label class="text-light">User</label>
            <select class="form-control" name="user_id">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="text-light">Score</label>
            <input class="form-control" type="text" name="score" placeholder="Enter the score here...">
            @if($errors->has('score'))
                <p class="text-danger">{{ $errors->first('score') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="text-light">Url</label>
            <input class="form-control" type="text" name="url" placeholder="Enter the proof url here...">
            @if($errors->has('url'))
                <p class="text-danger">{{ $errors->first('url') }}</p>
            @endif
        </div>
        <button type="submit">Create</button>
    </form>
@endsection