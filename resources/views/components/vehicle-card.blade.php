<div class="card border-0 h-100" style="width: 16rem;">
    <img class="card-img-top" src="{{ Storage::disk('s3')->url($vehicle->thumbnail) }}" alt="Slika vozila">
    <div class="card-body">
        <a href="{{ route('vozila.show', ['vozila' => $vehicle->id]) }}"class="text-black"><h5 class="card-title">{{ $vehicle->name }}</h5></a>
        <div class="container p-0">
            <div class="row">
                <div class="col-6">
                    <h6> <i class="fa-regular fa-calendar text-icon-small mt-2"></i> {{ $vehicle->production_year }}
                    </h6>
                </div>
                <div class="col-6">
                    <h6><i class="fa-solid fa-gears mt-2 text-icon-small"></i>{{ $vehicle->gearbox }}</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <h6><i
                            class="fa-solid fa-horse-head mt-2 text-icon-small"></i>{{ $vehicle->engine_strength . ' KS' }}
                    </h6>
                </div>
                <div class="col-6">
                    <h6><i class="fa-solid fa-gas-pump mt-2 text-icon-small"></i>{{ $vehicle->engine_type }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-white bg-primary pb-0">
        <div class="d-flex align-items-center justify-content-between">
            <h6 style="margin-top: 2px;"> <i class="fa-solid fa-gauge"></i> {{ number_format($vehicle->kilometers, 0) }}</h6>
            <h5>{{ number_format($vehicle->price, 0) . ' KM' }}</h5>
        </div>
    </div>
</div>
