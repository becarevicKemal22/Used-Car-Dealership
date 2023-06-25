@extends('layouts.app')

@section('content')
    <form action="{{ route('vehicles.update', ['vehicle' => $vehicle->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('vehicles._formEdit')
        <br>
        <button type="submit">Submit</button>
    </form>
@endsection
