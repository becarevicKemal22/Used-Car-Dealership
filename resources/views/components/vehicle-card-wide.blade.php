<div {{ $attributes->merge(['class' => 'card border-0 h-100 vehicle-card']) }}>
    <div class="row no-gutters">
        <div class="col-md-3 no-padding">
            <img class="card-img-top" src="{{ Storage::disk('s3')->url($vehicle->thumbnail) }}" alt="Slika vozila">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <a href="{{ route('vozila.show', ['vozila' => $vehicle->id]) }}"class="text-black">
                    <h5 class="card-title">{{ $vehicle->name }}</h5>
                </a>
                <div class="row d-flex">
                    <h6> <i class="fa-regular fa-calendar text-icon-small mt-2"></i> {{ $vehicle->production_year }}
                    </h6>

                    <h6><i class="fa-solid fa-gears mt-2 text-icon-small"></i>{{ $vehicle->gearbox }}</h6>

                    <h6><i
                            class="fa-solid fa-horse-head mt-2 text-icon-small"></i>{{ $vehicle->engine_strength . ' KS' }}
                    </h6>

                    <h6><i class="fa-solid fa-gas-pump mt-2 text-icon-small"></i>{{ $vehicle->engine_type }}</h6>
                </div>
            </div>
        </div>

        <div class="card-footer text-white bg-primary pb-0">
            <div class="d-flex align-items-center justify-content-between">
                <h6 style="margin-top: 2px;"> <i class="fa-solid fa-gauge"></i>
                    {{ number_format($vehicle->kilometers, 0) }}
                </h6>
                @if ($vehicle->discount_price != null && $vehicle->discount_price > 0)
                    <div class="d-flex flex-column align-items-end gap-0">
                        <strike>
                            <h6 style="margin-bottom: 0;">{{ number_format($vehicle->price, 0) . ' KM' }}</h6>
                        </strike>
                        <h5>{{ number_format($vehicle->discount_price, 0) . ' KM' }}</h5>
                    </div>
                @else
                    <h5>{{ number_format($vehicle->price, 0) . ' KM' }}</h5>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    @media only screen and (max-width: 768px) {
        .vehicle-card {
            width: 14rem;
        }

        .vehicle-card img {
            max-height: none !important;
            width: 100% !important;
            height: auto !important;
            padding: 0 !important;
        }

        .no-padding {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    }

    .vehicle-card img {
        max-height: 7rem;
        width: auto;
    }

    .vehicle-card h6 {
        width: fit-content;
    }


    .no-padding {
        padding-left: 0 !important;
    }
</style>
