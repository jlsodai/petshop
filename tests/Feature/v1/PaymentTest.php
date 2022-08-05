<?php

namespace Tests\Feature\v1;

use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_payment_routes_exist()
    {
        $this->assertTrue(Route::has('v1.payments.index'));
        $this->assertTrue(Route::has('v1.payments.create'));
        $this->assertTrue(Route::has('v1.payments.show'));
        $this->assertTrue(Route::has('v1.payments.update'));
        $this->assertTrue(Route::has('v1.payments.delete'));
    }

    public function test_it_lists_all_payments()
    {
        $response = $this->getJson(route('v1.payments.index'));
        $response->assertStatus(200);
    }

    public function test_it_creates_a_new_payment()
    {
        $this->withExceptionHandling();
        $payment = Payment::factory()->raw(['type' => '']);
        $response = $this->postJson(route('v1.payments.create', $payment));
        $response->assertJsonValidationErrors('type');
    }

    public function test_it_requires_payment_details()
    {
        $this->withExceptionHandling();
        $payment = Payment::factory()->raw(['details' => '']);
        $response = $this->postJson(route('v1.payments.create', $payment));
        $response->assertJsonValidationErrors('details');
    }

    public function test_it_fetches_a_payment()
    {
        $payment = Payment::factory()->create();
        $response = $this->getJson(route('v1.payments.show', $payment));
        $response->assertStatus(200);
    }

    public function test_it_updates_an_existing_payment()
    {
        $payment = Payment::factory()->create();
        $newPayment = Payment::factory()->raw();
        $response = $this->putJson(route('v1.payments.update', $payment), $newPayment);
        $response->assertStatus(200);
    }

    public function test_it_deletes_an_existing_payment()
    {
        $payment = Payment::factory()->create();
        $response = $this->deleteJson(route('v1.payments.delete', $payment));
        $response->assertStatus(200);
    }
}
