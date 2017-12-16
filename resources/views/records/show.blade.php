@extends('layouts.main')

@section('title', $record->name)

@section('content')
    <h1 class="text-light">{{ $record->name }}</h1>

@stop