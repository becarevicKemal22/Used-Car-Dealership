<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehicleTypePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.h
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
