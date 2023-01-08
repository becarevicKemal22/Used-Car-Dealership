@extends('layouts.app')

@section('content')

<form action="{{ route('manufacturers.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Ime marke: </label>
        <input type="text" name="name" id="name"> <br>
    </div>
    <button type="submit">Dodaj marku</button>
</form>

@endsection