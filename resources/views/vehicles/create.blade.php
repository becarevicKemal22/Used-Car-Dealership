<form action="{{ route('vozila.store') }}" method="POST">
    @csrf
    @include('vehicles._form')
    <br>
    <button type="submit">Dodaj vozilo</button>
</form>
