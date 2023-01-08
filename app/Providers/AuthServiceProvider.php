<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Manufacturer;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Policies\VehicleModelAndManufacturerPolicy;
use App\Policies\VehiclePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Vehicle::class => VehiclePolicy::class,
        Manufacturer::class => VehicleModelAndManufacturerPolicy::class,
        VehicleModel::class => VehicleModelAndManufacturerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::resource('vehicles', VehiclePolicy::class);
        Gate::define('create', [VehicleModelAndManufacturerPolicy::class, 'create']);
    }
}
