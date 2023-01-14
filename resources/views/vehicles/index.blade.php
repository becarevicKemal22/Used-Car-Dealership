@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row gx-5">
            <div class="col-9 pt-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Nasa trenutna ponuda vozila</h4>
                    <div class="dropdown">
                        <button class="btn btn-secondary bg-primary text-white dropBtn" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="sortDropdown()">
                            Sortiranje <i class="fa-solid fa-sort" style="padding-left: 5px;"></i>
                        </button>
                        <div class="dropdown-menu" id="sortDropdown" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"
                                href="{{ route('vozila.index', array_merge(\Request::query(), ['sort' => 'manufacturer asc'])) }}">Marka
                                A-Z</a>
                            <a class="dropdown-item"
                                href="{{ route('vozila.index', array_merge(\Request::query(), ['sort' => 'manufacturer desc'])) }}">Marka
                                Z-A</a>
                            <a class="dropdown-item"
                                href="{{ route('vozila.index', array_merge(\Request::query(), ['sort' => 'price asc'])) }}">Cijena
                                uzlazna</a>
                            <a class="dropdown-item"
                                href="{{ route('vozila.index', array_merge(\Request::query(), ['sort' => 'price desc'])) }}">Cijena
                                silazna</a>
                            <a class="dropdown-item"
                                href="{{ route('vozila.index', array_merge(\Request::query(), ['sort' => 'year asc'])) }}">Godina
                                proizvodnje: najstarije prvo</a>
                            <a class="dropdown-item"
                                href="{{ route('vozila.index', array_merge(\Request::query(), ['sort' => 'year desc'])) }}">Godina
                                proizvodnje: najnovije prvo</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('vozila.index') }}" method="GET">
                    <div class="input-group mt-4 mb-4 d-flex justify-content-center">
                        <div class="form-outline w-75">
                            <input type="search" id="pretraga" name="pretraga" class="form-control"
                                placeholder="Pretraga vozila" />
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>




                @foreach ($vehicles as $vehicle)
                    <p>{{ $vehicle->name }}</p>
                @endforeach
            </div>
            <div class="col-lg-3 pt-3 filters">
                <h2>Detaljna pretraga</h2>
                <form action="{{ route('vozila.index') }}" method="GET">
                    <label for="manufacturer"><i class="fa-solid fa-industry" style="color: #8a1820; padding-right: 0.5em;"></i> Marka</label> <br>
                    <select id="manufacturer" name="manufacturer" class="btn btn-sm btn-secondary w-100 mt-1 mb-2">

                    </select> <br>
                    <div class="modeli hidden">
                        <label for="vehicle_model_id"><i class="fa-solid fa-car" style="color: #8a1820; padding-right: 0.5em;"></i> Model</label> <br>
                        <select name="vehicle_model_id" id="vehicle_model_id"
                            class="btn btn-sm btn-secondary w-100 mt-1 mb-2">

                        </select> <br>
                    </div>

                    <label for=""><i class="fa-regular fa-calendar mt-2" style="padding-right: 0.5em; color: #8a1820"></i>Godina proizvodnje</label> <br>
                    <div class="godine d-flex gap-3">
                        <select name="years_from" id="years_from" class="btn btn-sm btn-secondary w-100 mt-1 mb-2">
                            <option value="" disabled selected hidden>Od</option>
                            <option value=""></option>
                            @for ($i = 1995; $i < now()->year; $i++)
                                <option value="{{ $i }}">{{ $i }} </option>
                            @endfor
                        </select>
                        <select name="years_to" id="years_to" class="btn btn-sm btn-secondary w-100 mt-1 mb-2">
                            <option value="" disabled selected hidden>Do</option>
                            <option value=""></option>
                            @for ($i = 1995; $i < now()->year; $i++)
                                <option value="{{ $i }}">{{ $i }} </option>
                            @endfor
                        </select>
                    </div>

                    <label for=""><i class="fa-solid fa-hand-holding-dollar mt-2" style="color: #8a1820; padding-right: 0.5em;"></i> Cijena</label> <br>
                    <div class="godine d-flex gap-3">
                        <select name="price_from" id="price_from" class="btn btn-sm btn-secondary w-100 mt-1 mb-2">
                            <option value="" disabled selected hidden>Od</option>
                            <option value=""></option>
                        </select>
                        <select name="price_to" id="price_to" class="btn btn-sm btn-secondary w-100 mt-1 mb-2">
                            <option value="" disabled selected hidden>Do</option>
                            <option value=""></option>
                        </select>
                    </div>

                    <label for=""><i class="fa-solid fa-bars mt-2" style="color: #8a1820; padding-right: 0.5em;"></i> Kategorije vozila</label>
                    <div class="kategorije mt-2">
                        @foreach ($types as $type)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name={{ 'type'.$type->id }} id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $type->name }}
                                </label>
                                <img src="{{ Storage::disk('s3')->url('icons/'.strtolower($type->name)).'.svg' }}" alt="" class="icon">
                            </div>
                        @endforeach

                    </div>

                    <label for=""><i class="fa-solid fa-filter mt-3" style="color: #8a1820; padding-right: 0.5em;"></i>Ostali filteri</label>
                    <div class="ostali">
                        <label for=""><i class="fa-solid fa-gears mt-3" style="color: #8a1820; padding-right: 0.5em;"></i> Mjenjač</label>
                        <select name="gearbox" id="gearbox" class="btn btn-sm btn-secondary w-100 mt-1 mb-2">
                            <option value=""></option>
                            <option value="automatik">Automatik</option>
                            <option value="manuelni">Manuelni</option>
                        </select>
                        <label for=""><i class="fa-solid fa-gas-pump mt-3" style="color: #8a1820; padding-right: 0.5em;"></i>Gorivo</label>
                        <select name="engine_type" id="engine_type" class="btn btn-sm btn-secondary w-100 mt-1 mb-2">
                            <option value=""></option>
                            <option value="benzin">Benzin</option>
                            <option value="dizel">Dizel</option>
                            <option value="hibrid">Hibrid</option>
                            <option value="elektricni">Električni</option>
                        </select>
                    </div>

                    <div class="dugme d-flex mt-4 pb-4 justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg bg-primary text-white"> <i
                                class="fas fa-search"></i> Pretrazi</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function updateModelDropdown(models) {

            let div = document.querySelector('.modeli');
            div.classList.remove('hidden');

            let modelDropdown = document.getElementById('vehicle_model_id');
            let val = document.getElementById('manufacturer').value;

            //Remove all children
            let child = modelDropdown.lastElementChild;
            while (child) {
                modelDropdown.removeChild(child);
                child = modelDropdown.lastElementChild;
            }

            let option = document.createElement('option');
            option.value = 0;
            modelDropdown.appendChild(option);

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

        function giveModelDefaultOption() {
            let modelDropdown = document.getElementById('vehicle_model_id');
            let option = document.createElement('option');
            option.value = 0;
            modelDropdown.appendChild(option);
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

        let option = document.createElement('option');
        option.value = 0;
        manufacturerDropdown.appendChild(option);

        giveModelDefaultOption();

        manufacturers.forEach(manufacturer => {
            const option = document.createElement('option');
            option.value = manufacturer.id;
            option.text = manufacturer.name;
            manufacturerDropdown.appendChild(option);
        });

        manufacturerDropdown.addEventListener('change', () => {
            updateModelDropdown(models);
        });
    </script>

    <script>
        function sortDropdown() {
            document.getElementById("sortDropdown").classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.classList.contains('dropBtn')) {
                console.log(event.target.classList.contains('dropBtn'));
                let dropdowns = document.getElementsByClassName("dropdown-menu");
                let i;
                for (i = 0; i < dropdowns.length; i++) {
                    let openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
@endsection
