@extends('layouts.main')

@section('title', 'Creating a genre')

@section('content')
    <h1 class="text-light">Creating a genre</h1>

    <form action="/genres/create" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
            <label class="text-light">Name</label>
            <input class="form-control" type="text" name="name" placeholder="Enter a name for the genre">
            @if($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <button type="submit">Create</button>
    </form>
@endsection