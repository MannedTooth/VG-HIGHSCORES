@extends('layouts.main')

@section('title', $game->name)

@section('content')
    <h1 class="text-light">{{ $game->name }}</h1>
@stop