@extends('layouts.main')

@section('title', 'Games')

@section('content')
    <h1 class="text-light">Browsing games</h1>
    @if (Gate::allows('create-games'))
        <a href="/games/create">Create a new game</a>
    @endif
    <ul class="list-inline text-center">
        @foreach ($games as $game)
            <li class="list-inline-item">
                <img src="{{ asset('/img/' + $game->nickname + '/cover.png') }}" height="128px">
                <p>
                    <a href="/games/{{ $game->nickname }}/records" class="link-color-white">{{ $game->name }}</a>
                    <br><small class="text-light">0 records</small>
                @if (Gate::allows('edit-games') || Gate::allows('delete-games'))
                    <br>
                        @if (Gate::allows('edit-games'))
                            <a href="/games/edit/{{ $game->nickname }}">
                                <i>edit</i>
                            </a>
                        @endif
                        @if (Gate::allows('delete-games'))
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-game-{{ $game->id }}').submit();">
                                <i>delete</i>
                            </a>

                            <form id="delete-game-{{ $game->id }}" action="/games/{{ $game->id }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        @endif
                    @endif
                </p>
            </li>
        @endforeach
    </ul>
@stop