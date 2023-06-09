<div style="margin-left: 20px;">

    <label for="name">Ime vozila: </label>
    <input type="text" name="name" id="name" value="{{ old('name') }}"> <br>

    <label for="price">Cijena: </label>
    <input type="text" name="price" id="price" value="{{ old('price') }}"> <br>

    <label for="dicsount_price">Akcijska cijena: </label>
    <input type="text" name="discount_price" id="discount_price" value="{{ old('discount_price') }}"> <br>

    <label for="production_year">Godina proizvodnje: </label>
    <input type="number" name="production_year" id="production_year" value="{{ old('production_year') }}"> <br>

    <label for="kilometers">Kilometri: </label>
    <input type="number" name="kilometers" id="kilometers" value="{{ old('kilometers') }}"> <br>

    <label for="engine_type">Tip motora / gorivo: </label>
    <input type="text" name="engine_type" id="engine_type" value="{{ old('engine_type') }}"> <br>

    <label for="chassis_type">Vrsta karoserije: </label>
    <input type="text" name="chassis_type" id="chassis_type" value="{{ old('chassis_type') }}"> <br>

    <label for="gearbox">Transmisija: </label>
    <input type="text" name="gearbox" id="gearbox" value="{{ old('gearbox') }}"> <br>

    <label for="color">Boja: </label>
    <input type="text" name="color" id="color" value="{{ old('color') }}"> <br>

    <label for="door_number">Broj vrata: </label>
    <input type="text" name="door_number" id="door_number" value="{{ old('door_number') }}"> <br>

    <label for="engine_volume">Kubikaza: </label>
    <input type="text" name="engine_volume" id="engine_volume" value="{{ old('engine_volume') }}"> <br>

    <label for="engine_strength">Konjskih snaga: </label>
    <input type="number" name="engine_strength" id="engine_strength" value="{{ old('engine_strength') }}"> <br>

    <label for="drive">Pogon: </label>
    <input type="text" name="drive" id="drive" value="{{ old('drive') }}"> <br>

    {{-- <label for="status_id">Status: </label>
<input type="text" name="status_id" id="status_id"> <br> --}}
    <label for="opis">Opis: </label> <br>
    <textarea name="opis" id="opis" cols="30" rows="10">{{ old('opis') }}</textarea> <br>

    @foreach ($equipment as $item)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                name={{ 'equipment' . $item->id }} id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                {{ $item->equipment_name }}
            </label>
        </div>
    @endforeach

    <input class="form-check-input" type="checkbox" value="1" name="uDolasku" id="flexCheckDefault">
    <label class="form-check-label" for="flexCheckDefault">
        U dolasku?
    </label>

    <select id="manufacturer" name="manufacturer">

    </select> <br>

    <select name="vehicle_model_id" id="vehicle_model_id">

    </select> <br>

    <div class="form-group">
        <label>Thumbnail</label>
        <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
    </div>

    <div class="form-group">
        <label>Ostale slike: </label>
        <input type="file" name="photos[]" id="photos[]" class="form-control-file" multiple>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color:red">{{ $error }}</p>
        @endforeach
    @endif

</div>

<script>
    function updateModelDropdown(models) {
        let modelDropdown = document.getElementById('vehicle_model_id');
        let val = document.getElementById('manufacturer').value;

        //Remove all children
        let child = modelDropdown.lastElementChild;
        while (child) {
            modelDropdown.removeChild(child);
            child = modelDropdown.lastElementChild;
        }

        //Add new models
        models.forEach(element => {
            if (element.manufacturer_id != val) {
                return;
            }

            let option = document.createElement('option');
            option.value = element.id;
            option.text = element.name;
            modelDropdown.appendChild(option);
        })
    }

    let models = @json($models->toArray());
    let manufacturers = [];
    let ids = [];
    models.forEach(element => {
        if (ids.includes(element.manufacturer.id)) {
            return;
        }
        manufacturers.push(element.manufacturer);
        ids.push(element.manufacturer.id);
    });

    const manufacturerDropdown = document.querySelector('#manufacturer');

    manufacturers.forEach(manufacturer => {
        const option = document.createElement('option');
        option.value = manufacturer.id;
        option.text = manufacturer.name;
        manufacturerDropdown.appendChild(option);
    });

    updateModelDropdown(models);

    manufacturerDropdown.addEventListener('change', () => {
        updateModelDropdown(models);
    });
</script>
