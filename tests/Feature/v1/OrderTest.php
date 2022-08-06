<?php

namespace Tests\Feature\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_order_routes_exist()
    {
        $this->assertTrue(Route::has('v1.orders.index'));
        $this->assertTrue(Route::has('v1.orders.create'));
        $this->assertTrue(Route::has('v1.orders.show'));
        $this->assertTrue(Route::has('v1.orders.update'));
        $this->assertTrue(Route::has('v1.orders.delete'));
        $this->assertTrue(Route::has('v1.orders.download'));
        $this->assertTrue(Route::has('v1.orders.dashboard'));
        $this->assertTrue(Route::has('v1.orders.shipmentLocator'));
    }
}
