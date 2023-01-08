@extends('layouts.app')

@section('content')
    @foreach ($vehicles as $vehicle)
        <p>{{ $vehicle->name }}</p>
    @endforeach
@endsection
