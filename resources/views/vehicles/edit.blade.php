<form action="{{ route('vozila.update', ['vozila' => $vehicle->id]) }}" method="POST">
    @csrf
    @method('PUT')
    @include('vehicles._form')
    <br>
    <button type="submit">Spremi</button>
</form>