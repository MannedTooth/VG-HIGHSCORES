@extends('layouts.main')

@section('title', $game->name)

@section('content')

    @if (Gate::allows('create-records'))
        <a href="/games/{{ $game->nickname }}/records/create">Create a new record</a>
    @endif

    <div class="container mt-3">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('storage/covers/' . $game->cover_image->source_url)  }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $game->name }}</h4>
                        <p class="card-text"><strong>Release:</strong> {{ $game->release_year }}</p>
                        <p class="card-text">{{ $game->description }}</p>
                        <a href="/games/{{ $game->nickname }}/records/suggest" class="btn btn-primary w-100">Suggest a record!</a>
                    </div>
                </div>
            </div>
            <div class="col-9">
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
                            <td>{{ $record->attempts->count() }}</td>
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
            </div>
        </div>
    </div>




@stop