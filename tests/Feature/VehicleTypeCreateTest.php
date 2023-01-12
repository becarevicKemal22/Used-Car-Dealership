<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleTypeCreateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = $this->user();

        $response = $this->actingAs($user)->get('/novi_tip');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->post('/novi_tip', ['name' => 'Vehicle Type']);
        $response->assertStatus(302)->assertSessionHas(['status' => 'Tip uspjesno dodan.']);
    }
}
