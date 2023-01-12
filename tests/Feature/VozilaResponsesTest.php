<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Vehicle;
use Tests\TestCase;

class VozilaResponsesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexPage()
    {
        $response = $this->get('/vozila');

        $response->assertStatus(200);
        $response->assertSeeText('PEUGEOT 308');
    }

    //! Doesnt work with s3 because the thumbnail path isnt okay. 
    //TODO Possible solution is to add a permanent tester in s3 for thunbnails and add that to these seeders.
    //TODO Also add a testVehicle seeder so that real model examples are not used in tests.
    // public function testShowPage(){
    //     $response = $this->get('/vozila');

    //     $response = $this->get('/vozila/2');
    //     $response->assertStatus(200);
    //     $response->assertSeeText('PEUGEOT 4008');
        
    //     $response = $this->get('/vozila/0');
    //     $response->assertStatus(404);
    // }

    public function testDeleteRequest(){
        $user = $this->user();
        $response = $this->actingAs($user)->delete('/vozila/1');
        $response->assertStatus(302);
        $this->assertDatabaseMissing('vehicles', ['name' => 'PEUGEOT 308 SW 1.6 HDI , 2014 GODINA, NAVIGACIJA']);
    }
}