<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Manufacturer;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDatabaseTables()
    {
        $this->artisan('migrate:fresh');
        $manufacturer = new Manufacturer();
        $manufacturer->name = 'My manufacturer';
        $manufacturer->save();

        $model = new VehicleModel();
        $model->name = '4008';
        $model->save();

        $car = Vehicle::factory()->peugeot4008()->make();
        $car->vehicle_model_id = $model->id;
        $car->save();

        $this->assertDatabaseHas('vehicles', ['id' => 1]);
    }
}