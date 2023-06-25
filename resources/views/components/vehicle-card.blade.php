    <div {{ $attributes->merge(['class' => 'card border-0 h-100 vehicle-card']) }}>
        @if($vehicle->thumbnail)
            <img class="card-img-top" src="{{ Storage::disk('s3')->url($vehicle->thumbnail) }}"
                alt="Vehicle picture">
        @else
            <img class="card-img-top" alt="Placeholder" src="https://placehold.co/600x600">
        @endif
        @if ($vehicle->status == 'u_dolasku')
            <span class="ribbon uDolasku"></span>
        @elseif ($vehicle->discount_price > 0)
            <span class="ribbon discount"></span>
        @elseif($latest != null and $latest->contains('id', $vehicle->id))
            <span class="ribbon novo"></span>
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $vehicle->name }}</h5>

            <div class="container p-0">
                <div class="row">
                    <div class="col-6">
                        <h6> <i class="fa-regular fa-calendar text-icon-small mt-2"></i>
                            {{ $vehicle->production_year }}
                        </h6>
                    </div>
                    <div class="col-6">
                        <h6><i class="fa-solid fa-gears mt-2 text-icon-small"></i>{{ $vehicle->gearbox }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h6><i
                                class="fa-solid fa-horse-head mt-2 text-icon-small"></i>{{ $vehicle->engine_strength . ' HP' }}
                        </h6>
                    </div>
                    <div class="col-6">
                        <h6><i class="fa-solid fa-gas-pump mt-2 text-icon-small"></i>{{ $vehicle->engine_type }}
                        </h6>
                    </div>
                </div>
            </div>
            <a href="{{ route('vehicles.show', ['vehicle' => $vehicle->id]) }}" class="stretched-link"></a>
        </div>
        <div class="card-footer text-white bg-primary pb-0">
            <div class="d-flex align-items-center justify-content-between">
                <h6 style="margin-top: 2px;"> <i class="fa-solid fa-gauge-simple"></i>
                    {{ number_format($vehicle->kilometers, 0).'km' }}
                </h6>

                @if ($vehicle->discount_price != null && $vehicle->discount_price > 0)
                    <div class="d-flex flex-column align-items-end gap-0">
                        <strike>
                            <h6 style="margin-bottom: 0;">{{ number_format($vehicle->price, 0) . ' €' }}</h6>
                        </strike>
                        <h5>{{ number_format($vehicle->discount_price, 0) . ' €' }}</h5>
                    </div>
                @else
                    <h5>{{ number_format($vehicle->price, 0) . ' €' }}</h5>
                @endif
            </div>
        </div>
    </div>
    <style>
        .vehicle-card {
            width: 16rem;
            overflow: hidden;
        }

        .ribbon {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            background-size: contain;
            background-repeat: no-repeat;
        }

        .discount {

            background-image: url('{{ Storage::disk('s3')->url('assets/akcijaRibbon.webp') }}');

        }

        .uDolasku {
            background-image: url('{{ Storage::disk('s3')->url('assets/dolazakRibbon.webp') }}');
        }

        .novo {
            background-image: url('{{ Storage::disk('s3')->url('assets/novoRibbon.webp') }}');
        }
    </style>
