@extends('layouts.app')

@section('content')
    <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('vehicles._formCreate')
        <br>
        <button type="submit">Add vehicle</button>
    </form>
@endsection
