<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteProtectionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_route_protection()
    {
        $response = $this->get('/nova_marka');
        $response->assertStatus(403);

        $response = $this->get('/novi_model');
        $response->assertStatus(403);
        $response = $this->get('/novi_tip');
        $response->assertStatus(403);
        $response = $this->get('/nova_oprema');
        //Here it is 302 because the controller is using auth middleware which redirects to login page.
        $response->assertStatus(302);
        $response = $this->get('/vozila/create');
        $response->assertStatus(403);
        $response = $this->get('/vozila/1/edit');
        $response->assertStatus(403);

        $response = $this->delete('/vozila/1');
        $response->assertStatus(403);
    }
}