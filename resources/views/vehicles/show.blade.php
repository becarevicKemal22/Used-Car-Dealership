@extends('layouts.app')

@section('content')
    <h1>{{ $vehicle->name }}</h1>
    <img src="{{ Storage::url($vehicle->thumbnail) }}" alt="">
    <h1>Ostale slike</h1>
    @foreach ($imagePaths as $path)
        <img src="{{ Storage::disk('s3')->url($path) }}" alt="">
    @endforeach
@endsection