@extends('layouts.main')

@section('title', $game->name)

@section('content')
    <h1 class="text-light">{{ $game->name }}</h1>

    @if (Gate::allows('create-records'))
        <a href="/games/{{ $game->nickname }}/records/create">Create a new record</a>
    @endif

    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scopre="col">Number of attempts</th>
            @if (Gate::allows('edit-records') || Gate::allows('delete-records'))
                <th scope="col">Options</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($game->records as $record)
            <tr>
                <td><a href="/games/{{ $game->nickname }}/records/{{ $record->id }}">{{ $record->name }}</a></td>
                <td>0</td>
                @if (Gate::allows('edit-records') || Gate::allows('delete-records'))
                    <td>
                        @if (Gate::allows('edit-records'))
                            <a href="/games/{{ $game->nickname }}/records/{{ $record->id }}/edit">
                                <i>edit</i>
                            </a>
                        @endif
                        @if (Gate::allows('delete-records'))
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-record-{{ $record->id }}').submit();">
                                <i>delete</i>
                            </a>

                            <form id="delete-record-{{ $record->id }}" action="/games/{{ $game->nickname }}/records/{{ $record->id }}" method="POST" style="display: none;">
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