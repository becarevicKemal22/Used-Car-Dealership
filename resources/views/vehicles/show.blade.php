@extends('layouts.app')

@section('content')
    <h1>{{ $vehicle->name }}</h1>
    <img src="{{ Storage::url($vehicle->thumbnail) }}" alt="">
@endsection