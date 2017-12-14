@extends('layouts.main')

@section('title', 'Genres')

@section('content')
    <h1>Genres</h1>
    @if (Gate::allows('create-genres'))
        <a href="/genres/create">Create a new genre</a>
    @endif
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Name</th>
                @if (Gate::allows('edit-genres') || Gate::allows('delete-genres'))
                    <th scope="col">Options</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($genres as $genre)
                <tr>
                    <td>{{ $genre->name }}</td>
                    @if (Gate::allows('edit-genres') || Gate::allows('delete-genres'))
                        <td>
                            @if (Gate::allows('edit-genres'))
                                <a href="/genres/edit/{{ $genre->id }}">
                                    <i>edit</i>
                                </a>
                            @endif
                            @if (Gate::allows('delete-genres'))
                                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-genre-{{ $genre->id }}').submit();">
                                    <i>delete</i>
                                </a>

                                <form id="delete-genre-{{ $genre->id }}" action="/genres/{{ $genre->id }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection