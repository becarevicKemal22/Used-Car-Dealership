<form action="{{ route('vehicleModels.store') }}" method="POST">
    @csrf
    <label for="name">Ime modela: </label>
    <input type="text" name="name" id="name"> <br>
    @if($errors->has('name'))
        <p style="color: red"> {{ $errors->name }}</p>
    @endif
    @if (!empty($manufacturers))
        <select name="manufacturer_id" id="manufacturer_id">
            @foreach ($manufacturers as $manufacturer)
                <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
            @endforeach
        </select> <br>
        @if($errors->has('manufacturer_id'))
            <p style="color:red">{{ $errors->manufacturer_id }}</p>
        @endif
    @else
        <h1>Ne postoji ni jedna marka kojoj auto moze pripadati. Molimo prvo kreirajte marku <a href="{{ route('manufacturers.create') }}">ovdje</a>.</h1>
        @endif
    <button type="submit">Dodaj model</button>
</form>