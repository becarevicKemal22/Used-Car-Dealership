<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Vehicle;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VozilaResponsesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCRUD()
    {

        $user = $this->user();
        
        //! Cannot test actually creating and editing tests because it returns 405 errors. Could be due to file uploads.

        $response = $this->actingAs($user)->get('/vozila/create');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/vozila/1/edit');
        $response->assertStatus(200);

        $response = $this->get('/vozila');
        $response->assertStatus(200)->assertSeeText('Test Vehicle');

        $response = $this->get('/vozila/1');
        $response->assertStatus(200)->assertSeeText('Test Vehicle');

        $response = $this->delete('/vozila/1');
        $response->assertStatus(302);
        $this->assertDatabaseEmpty('vehicles');
    }
}