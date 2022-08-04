<?php

namespace Tests\Feature\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class GeneralTest extends TestCase
{
    public function test_api_v1_route_exists()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
