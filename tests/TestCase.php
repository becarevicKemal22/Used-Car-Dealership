<?php

namespace Tests;

use App\Models\Manufacturer;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
 
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        //Seeding the database for testing.
        $testManufacturer = new Manufacturer();
        $testManufacturer->name = "My Manufacturer";
        $testManufacturer->save();

        $testType = new VehicleType();
        $testType->name = "My Vehicle Type";
        $testType->save();

        $testModel = new VehicleModel();
        $testModel->name = 'My Model';
        $testModel->manufacturer_id = Manufacturer::where('name', '=', 'My Manufacturer')->first()->id;
        $testModel->vehicle_type_id = 1;
        $testModel->save();

        $testVehicle = Vehicle::factory()->testVehicle()->make();
        $testVehicle->vehicle_model_id = VehicleModel::where('name', '=', 'My Model')->first()->id;
        $testVehicle->save();

        $this->withoutVite();

        // $this->artisan('db:seed');
    }

    public function user(){
        return User::factory()->create();
    }
}
