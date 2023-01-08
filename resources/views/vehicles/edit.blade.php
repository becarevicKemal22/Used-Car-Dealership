@extends('layouts.app')

@section()
    <form action="{{ route('vozila.update', ['vozila' => $vehicle->id]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('vehicles._formEdit')
        <br>
        <button type="submit">Spremi</button>
    </form>
@endsection
