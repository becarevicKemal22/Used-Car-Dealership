@extends('layouts.app')

@section('content')
    <h1>{{ $vehicle->name }}</h1>
    <img src="{{ $thumbnail }}" alt="">
    <h1>Ostale slike</h1>
    @foreach ($imagePaths as $path)
        <img src="{{ $path }}" alt="">
    @endforeach
@endsection