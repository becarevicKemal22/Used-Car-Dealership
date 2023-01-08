<form action="{{ route('manufacturers.store') }}" method="POST">
    @csrf
    <label for="name">Ime marke: </label>
    <input type="text" name="name" id="name"> <br>
    <button type="submit">Dodaj marku</button>
</form>