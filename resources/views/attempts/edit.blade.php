@extends('layouts.main')

@section('title', 'Editing an attempt')

@section('content')
    <h1 class="text-light">Editing an attempt : {{ $attempt->id }}</h1>

    <form action="/games/{{ $attempt->record->game->nickname }}/records/{{ $attempt->record->id }}/attempts/{{ $attempt->id }}/edit" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <input type="hidden" name="record_id" value="{{ $attempt->record->id }}">

        <div class="form-group">
            <label class="text-light">User</label>
            @if ($users->count() > 0)
                <select class="form-control" name="user_id">
                    @foreach ($users as $user)
                        @if ($user->id == $attempt->user_id)
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        @else
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            @endif
        </div>

        <div class="form-group">
            <label class="text-light">Score</label>
            <input class="form-control" type="text" name="score" value="{{ $attempt->score }}">
            @if($errors->has('score'))
                <p class="text-danger">{{ $errors->first('score') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label class="text-light">Url</label>
            <input class="form-control" type="text" name="url" value="{{ $attempt->url }}">
            @if($errors->has('url'))
                <p class="text-danger">{{ $errors->first('url') }}</p>
            @endif
        </div>

        <button type="submit">Update</button>
    </form>
@endsection