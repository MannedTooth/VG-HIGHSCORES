@extends('layouts.main')

@section('title', $record->name)

@section('content')
    <h1 class="text-light">{{ $record->name }}</h1>

    @if (Gate::allows('create-attempts'))
        <a href="/games/{{ $game->nickname }}/records/{{ $record->id }}/attempts/create">Create a new attempt</a>
    @endif

    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">Rank</th>
            <th scope="col">User</th>
            <th scopre="col">Score</th>
            @if (Gate::allows('edit-attempts') || Gate::allows('delete-attempts'))
                <th scope="col">Options</th>
            @endif
        </tr>
        </thead>
        @php ($counter = 0)
        <tbody>
        @foreach($record->attempts as $attempt)
            @php ($counter++)
            <tr>
                <td scope="row">{{ $counter }}</td>
                <td><a href="/users/{{ $attempt->user->name }}">{{ $attempt->user->name }}</a></td>
                <td><a href="/games/{{ $game->nickname }}/records/{{ $record->id }}/attempts/{{ $attempt->id }}">{{ $attempt->score }} {{ $record->unit }}</a></td>
                @if (Gate::allows('edit-attempts') || Gate::allows('delete-attempts'))
                    <td>
                        @if (Gate::allows('edit-attempts'))
                            <a href="/games/{{ $game->nickname }}/records/{{ $record->id }}/attempts/{{ $attempt->id }}/edit">
                                <i>edit</i>
                            </a>
                        @endif
                        @if (Gate::allows('delete-attempts'))
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-attempt-{{ $attempt->id }}').submit();">
                                <i>delete</i>
                            </a>

                            <form id="delete-attempt-{{ $attempt->id }}" action="/games/{{ $game->nickname }}/records/{{ $record->id }}/attempts/{{ $attempt->id }}" method="POST" style="display: none;">
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
@stop