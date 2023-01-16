<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManufacturersAndModelsCreateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNewModelAndManufacturer()
    {
        $user = $this->user();

        //Nova marka
        $response = $this->actingAs($user)->get('/nova_marka');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->post('/nova_marka', ['name' => 'Manufacturer']);
        $response->assertStatus(302)->assertSessionHas(['status' => 'Marka uspjesno dodana.']);
        
        //Novi model
        $response = $this->actingAs($user)->get('/novi_model');
        $response->assertStatus(200);
        $response = $this->actingAs($user)->post('/novi_model', ['name' => 'mojModel', 'manufacturer_id' => 1, 'vehicle_type_id' => 1]);
        $response->assertStatus(302)->assertSessionHas(['status' => 'Model uspjesno dodan.']);

        $this->assertDatabaseHas('manufacturers', ['name' => 'Manufacturer']);
        $this->assertDatabaseHas('vehicle_models', ['name' =>'mojModel']);
    }
}
