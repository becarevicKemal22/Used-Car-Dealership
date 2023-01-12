@extends('layouts.app')

@section('content')
    <form action="{{ route('vehicleTypes.store') }}" method="POST">
        @csrf
        <label for="name">Ime tipa: </label>
        <input type="text" name="name" id="name"> <br>
        @if ($errors->has('name'))
            <p style="color: red"> {{ $errors->name }}</p>
        @endif
        <button type="submit">Dodaj tip</button>
    </form>
@endsection
