<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class VehicleModelAndManufacturerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(){
        return Auth()->check();
    }
}
