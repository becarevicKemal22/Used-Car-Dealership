@extends('layouts.app')

@section('content')
    <form action="{{ route('equipment.store') }}" method="POST">
        @csrf
        <label for="equipment_name">Ime opreme: </label>
        <input type="text" name="equipment_name" id="equipment_name"> <br>
        @if ($errors->has('equipment_name'))
            <p style="color: red"> {{ $errors->name }}</p>
        @endif
        <button type="submit">Dodaj opremu</button>
    </form>
@endsection