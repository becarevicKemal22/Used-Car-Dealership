@extends('layouts.app')

@section('content')
    <form action="{{ route('vozila.update', ['vozila' => $vehicle->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('vehicles._formEdit')
        <br>
        <button type="submit">Spremi</button>
    </form>
@endsection
