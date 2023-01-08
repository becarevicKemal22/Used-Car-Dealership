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
        $response = $this->get('/nova_marka');
        $response->assertStatus(200);

        $response = $this->post('/nova_marka', ['name' => 'Manufacturer']);
        $response->assertStatus(302)->assertSessionHas(['status' => 'Marka uspjesno dodana.']);
        
        $response = $this->get('/novi_model');
        $response->assertStatus(200);
        $response = $this->post('/novi_model', ['name' => 'mojModel', 'manufacturer_id' => 1]);
        $response->assertStatus(302)->assertSessionHas(['status' => 'Model uspjesno dodan.']);

        $this->assertDatabaseHas('manufacturers', ['name' => 'Manufacturer']);
        $this->assertDatabaseHas('vehicle_models', ['name' =>'mojModel']);
    }
}
