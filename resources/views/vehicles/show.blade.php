@extends('layouts.app')

@section('content')
    <div id="myModal" class="image-modal">
        <span class="image-modal-close"><i class="fa-solid fa-x"></i></span>

        <div style="position: relative;" class="d-flex justify-content-around align-items-center">
            <div class="overlay-chevron overlay-chevron-left">
                <i class="fa-solid fa-circle-chevron-left galleryDirection"></i>
            </div>
            <img class="image-modal-content" id="modalImg">
            <div class="overlay-chevron overlay-chevron-right">
                <i class="fa-solid fa-circle-chevron-right galleryDirection"></i>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6">
                <h3 class="text-center bold-text">{{ $vehicle->name }}</h3>
            </div>
        </div>
        <div class="row mt-2 gx-5">
            <div class="col-md-6">
                <img class="mt-2 rounded" src="{{ $thumbnail }}" alt="Slika vozila"
                    style="max-width: 100%; height: auto;" id="myImg">
                <div class="d-flex justify-content-center mt-4 flex-wrap gap-4">
                    @if (count($imagePaths) >= 3)
                        @for ($i = 0; $i < 3; $i++)
                            <div style="position: relative;">
                                <img src="{{ $imagePaths[$i] }}" alt=""
                                    style="max-height: 9rem; width: auto; cursor:pointer;" class="vehicleImage rounded">
                                @if ($i == 2)
                                    <span class="overlay-dots rounded" id="dots">
                                        <i class="fa-solid fa-ellipsis dots-icon"></i>
                                    </span>
                                @endif
                            </div>
                        @endfor
                    @endif
                    @if (count($imagePaths) >= 4)
                        @for ($i = 3; $i < count($imagePaths); $i++)
                            <img src="{{ $imagePaths[$i] }}" alt="" style="display: none;" class="vehicleImage">
                        @endfor
                    @endif
                </div>
            </div>
            <div class="col-md-6 mt-5 pi-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    @if ($vehicle->discount_price != null && $vehicle->discount_price > 0)
                        <div class="d-flex flex-column align-items-start gap-0">
                            <strike>
                                <h5 class="bold-text" style="margin-bottom: 0;">{{ number_format($vehicle->price, 0) . ' KM' }}</h3>
                            </strike>
                            <h3 class="bold-text"><i class="fa-solid fa-money-bill-wave" style="padding-right: 0.5em;"></i>{{ number_format($vehicle->discount_price, 0) . ' KM' }}</h3>
                        </div>
                    @else
                        <h3 class="bold-text"><i class="fa-solid fa-money-bill-wave" style="padding-right: 0.5em;"></i>{{ number_format($vehicle->price, 0) . ' KM' }}</h3>
                    @endif
                    <h3 class="bold-text"><i class="fa-solid fa-gauge"></i> {{ number_format($vehicle->kilometers, 0) }}
                    </h3>
                </div>
                <div class="d-flex justify-content-between flex-wrap mt-3 borders-top-bottom">
                    <h4> <i class="fa-regular fa-calendar text-icon-small mt-2"></i> {{ $vehicle->production_year }}
                        <h4><i class="fa-solid fa-gears mt-2 text-icon-small"></i>{{ $vehicle->gearbox }}</h4>
                        <h4><i
                                class="fa-solid fa-horse-head mt-2 text-icon-small"></i>{{ $vehicle->engine_strength . ' KS' }}
                        </h4>
                        <h4><i class="fa-solid fa-gas-pump mt-2 text-icon-small"></i>{{ $vehicle->engine_type }}</h4>
                </div>
                <div class="p-2 mt-2">
                    <div class="d-flex justify-content-between mt-1">
                        <p>Marka automobila: </p>
                        <p>{{ $vehicle->model->manufacturer->name }}</p>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <p>Model: </p>
                        <p>{{ $vehicle->model->manufacturer->name . ' ' . $vehicle->model->name }}</p>
                    </div>
                    @if ($vehicle->drive)
                        <div class="d-flex justify-content-between mt-1">
                            <p>Vrsta pogona: </p>
                            <p>{{ $vehicle->drive }}</p>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between mt-1">
                        <p>Boja: </p>
                        <p>{{ $vehicle->color }}</p>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <p>Zapremina motora: </p>
                        <p>{{ $vehicle->engine_volume }}</p>
                    </div>
                    @if ($vehicle->door_number)
                        <div class="d-flex justify-content-between mt-1">
                            <p>Marka automobila: </p>
                            <p>{{ $vehicle->model->manufacturer->name }}</p>
                        </div>
                    @endif
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center mt-3">
                    <h3 class="text-bold text-center">Imate pitanje u vezi auta?</h3>
                    <div class="d-flex justify-content-center gap-4 mt-1">
                        <a href="tel:+38762800800" style="font-size: 2.4em;"><i class="fa-solid fa-phone"></i></a>
                        <a href="" style="font-size: 2.5em"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.facebook.com/eurocentar.sarajevo/"style="font-size: 2.5em"><i
                                class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-5">
                <h3 class="bold-text">OPIS VOZILA</h3>
                <p style="font-size: 1rem;" class="p-1">{{ $vehicle->opis }}</p>
            </div>
            <div class="col-12 mt-5">
                <h3 class="bold-text">OPREMA VOZILA</h3>
                <div class="row" style="margin-left: 0.6em;">
                    <div class="col-md-6 mt-2">
                        @for ($i = 0; $i < count($vehicle->equipment) / 2; $i++)
                            <h4><i class="fa-solid fa-circle-check bold-text mb-3"
                                    style="padding-right: 0.5em;"></i>{{ $vehicle->equipment[$i]->equipment_name }}</h4>
                        @endfor
                    </div>
                    <div class="col-md-6 mt-md-2">
                        @for ($i = ceil(count($vehicle->equipment) / 2); $i < count($vehicle->equipment); $i++)
                            <h4><i class="fa-solid fa-circle-check bold-text mb-3"
                                    style="padding-right: 0.5em;"></i>{{ $vehicle->equipment[$i]->equipment_name }}</h4>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        @if (count($latest) >= 2)
            <div class="row mt-4">
                <h3 class="text-center mt-4 mb-4 bold-text">Najnovije iz ponude</h3>
                <div class="col-12">

                    <div class="d-flex flex-wrap justify-content-center align-items-center gap-5">
                        @foreach ($latest as $vehicle)
                            <x-vehicle-card :$vehicle></x-vehicle-card>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- <h1>{{ $vehicle->name }}</h1>
    <img src="{{ $thumbnail }}" alt="">
    <h1>Ostale slike</h1>
    <form action="{{ route('vozila.destroy', $vehicle->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Brisi</button>
    </form>
    --}}
    {{-- @foreach ($imagePaths as $path)
        <img src="{{ $path }}" alt="">
    @endforeach --}}

    <script>
        let idx = 0;

        let images = Array.from(document.getElementsByClassName("vehicleImage"));
        let dots = document.getElementById("dots");
        let modalImg = document.getElementById("modalImg");
        let closeBtn = document.getElementsByClassName('image-modal-close')[0].firstChild;
        let chevronLeft = document.querySelector('.overlay-chevron-left');
        let chevronRight = document.querySelector('.overlay-chevron-right');

        chevronLeft.addEventListener('click', () => {
            idx--;
            changeImage(images);
        });

        chevronRight.addEventListener('click', () => {
            idx++;
            changeImage(images);
        });

        function changeImage(images) {
            if (idx < 0) {
                idx = images.length - 1;
            } else if (idx > images.length - 1) {
                idx = 0;
            }

            modalImg.src = images[idx].src;
        }

        let modal = document.getElementById("myModal");

        closeBtn.onclick = function() {
            modal.classList.remove("visible");
        }

        images.forEach((img, index) => {
            img.onclick = function() {
                idx = index;
                console.log(idx);
                modal.classList.add("visible");
                modalImg.src = this.src;
            }
        });

        dots.onclick = function() {
            modal.classList.add("visible");
            modalImg.src = dots.previousElementSibling.src;
        }

        window.onclick = function() {
            console.log(event.target);
            if (event.target.classList.contains("image-modal")) {
                modal.classList.remove("visible");
            }
        }
    </script>
@endsection
