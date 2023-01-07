<form action="{{ route('vozila.store') }}" method="POST">
    @csrf
    @include('vehicles._form')
    <br>
    <button type="submit">Dodaj vozilo u bazu</button>

</form>
