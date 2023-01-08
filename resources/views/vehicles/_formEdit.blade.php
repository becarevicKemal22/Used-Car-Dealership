<label for="name">Ime vozila: </label>
<input type="text" name="name" id="name" value="{{ $vehicle->name ?? '' }}"> <br>

<label for="price">Cijena: </label>
<input type="text" name="price" id="price" value="{{ $vehicle->price ?? '' }}"> <br>

<label for="production_year">Godina proizvodnje: </label>
<input type="number" name="production_year" id="production_year" value="{{ $vehicle->production_year ?? '' }}"> <br>

<label for="kilometers">Kilometri: </label>
<input type="number" name="kilometers" id="kilometers" value="{{ $vehicle->kilometers ?? '' }}"> <br>

<label for="engine_type">Tip motora / gorivo: </label>
<input type="text" name="engine_type" id="engine_type" value="{{ $vehicle->engine_type ?? '' }}"> <br>

<label for="chassis_type">Vrsta karoserije: </label>
<input type="text" name="chassis_type" id="chassis_type" value="{{ $vehicle->chassis_type ?? '' }}"> <br>

<label for="gearbox">Transmisija: </label>
<input type="text" name="gearbox" id="gearbox" value="{{ $vehicle->gearbox ?? '' }}"> <br>

<label for="color">Boja: </label>
<input type="text" name="color" id="color" value="{{ $vehicle->color ?? '' }}"> <br>

<label for="door_number">Broj vrata: </label>
<input type="text" name="door_number" id="door_number" value="{{ $vehicle->door_number ?? '' }}"> <br>

<label for="engine_volume">Kubikaza: </label>
<input type="text" name="engine_volume" id="engine_volume" value="{{ $vehicle->engine_volume ?? '' }}"> <br>

<label for="engine_strength">Konjskih snaga: </label>
<input type="number" name="engine_strength" id="engine_strength" value="{{ $vehicle->engine_strength ?? '' }}"> <br>

<label for="drive">Pogon: </label>
<input type="text" name="drive" id="drive" value="{{ $vehicle->drive ?? '' }}"> <br>

{{-- <label for="status_id">Status: </label>
<input type="text" name="status_id" id="status_id"> <br> --}}
<label for="opis">Opis: </label> <br>
<textarea name="opis" id="opis" cols="30" rows="10">{{ $vehicle->opis ?? '' }}</textarea> <br>

<label for="oprema">Oprema: </label> <br>
<textarea name="oprema" id="oprema" cols="30" rows="10" >{{ $vehicle->oprema ?? '' }}</textarea> <br>


@php
    use Illuminate\Support\Facades\DB;

    if (DB::table('vehicle_models')->where('id', $vehicle->model_id)->exists()) {
        $model = App\Models\VehicleModel::find($vehicle->model_id);
        $model_name = $model->name;
        $model_id = $model->id;
        $manufacturer_name = $model->manufacturer->name;
        $manufacturer_id = $model->manufacturer->id;
    }
@endphp

<select id="manufacturer" name="manufacturer">
    @if($manufacturer_id)
        <option value="{{ $manufacturer_id }}"> {{ $manufacturer_name }} </option>
    @endif
</select> <br>

<select name="model_id" id="model_id">
    @if($model_id)
        <option value="{{ $model_id }}"> {{ $model_name }} </option>
    @endif
</select> <br>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color:red">{{ $error }}</p>
    @endforeach
@endif

<script>
    function updateModelDropdown(models) {
        let val = document.getElementById('manufacturer').value;
        let modelDropdown = document.getElementById('model_id');

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
