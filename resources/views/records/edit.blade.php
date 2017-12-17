@extends('layouts.main')

@section('title', 'Editing a record')

@section('content')
    <h1 class="text-light">Editing record : {{$record->id}}</h1>

    <form action="/games/{{ $record->game->nickname }}/records/{{ $record->id }}/edit" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label class="text-light">Name</label>
            <input class="form-control" type="text" name="name" value="{{ $record->name }}">
            @if($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="text-light">Unit</label>
            <input class="form-control" type="text" name="unit" value="{{ $record->unit }}">
            @if($errors->has('unit'))
                <p class="text-danger">{{ $errors->first('unit') }}</p>
            @endif
        </div>
        <button type="submit">Edit</button>
    </form>
@endsection