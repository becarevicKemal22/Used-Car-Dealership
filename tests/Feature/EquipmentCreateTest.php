<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EquipmentCreateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = $this->user();
        $response = $this->actingAs($user)->get('/nova_oprema');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->post('/nova_oprema', ['equipment_name' => 'testna_oprema']);
        $response->assertStatus(302);
        $this->assertDatabaseHas('equipment', ['equipment_name' => 'testna_oprema']);

        $vehicle = Vehicle::find(1);
        $vehicle->equipment()->attach(Equipment::find(1));
        $vehicle = Vehicle::with('equipment')->find(1);
        $this->assertEquals(1, count($vehicle->equipment));
    }
}
