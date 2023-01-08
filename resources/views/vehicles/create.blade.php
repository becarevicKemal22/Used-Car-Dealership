@extends('layouts.app')

@section('content')
    <form action="{{ route('vozila.store') }}" method="POST">
        @csrf
        @include('vehicles._formCreate')
        <br>
        <button type="submit">Dodaj vozilo</button>
    </form>
@endsection
