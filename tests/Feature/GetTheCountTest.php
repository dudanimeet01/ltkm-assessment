<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetTheCountTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_the_count()
    {
        $response = $this->post('/get-the-count', ['filename' => 'A.txt']);

        
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
            ]);
    }
}
