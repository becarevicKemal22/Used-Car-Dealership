@extends('layouts.app')

@section('content')
    <h1>{{ $vehicle->name }}</h1>
    <img src="{{ $thumbnail }}" alt="">
    <h1>Ostale slike</h1>
    <form action="{{ route('vozila.destroy', $vehicle->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Brisi</button>
    </form>
    @foreach ($imagePaths as $path)
        <img src="{{ $path }}" alt="">
    @endforeach
@endsection