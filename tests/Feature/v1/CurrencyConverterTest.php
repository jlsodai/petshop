<?php

namespace Tests\Feature\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrencyConverterTest extends TestCase
{
    public function test_currency_conversion_requires_amount()
    {
        $this->withExceptionHandling();
        $response = $this->getJson('/api/v1/currency/convert?currency=USD');
        $response->assertJsonValidationErrors('amount');
    }

    public function test_currency_conversion_requires_currency()
    {
        $this->withExceptionHandling();
        $response = $this->getJson('/api/v1/currency/convert?amount=200');
        $response->assertJsonValidationErrors('currency');
    }

    public function test_it_does_not_convert_when_currency_is_unavailabe()
    {
        $response = $this->getJson('/api/v1/currency/convert?currency=USSD&amount=200');
        $response->assertExactJson(["error" => "Currency not found"]);
    }

    public function test_currency_converts_when_amount_and_currency_exists()
    {
        $response = $this->getJson('/api/v1/currency/convert?currency=USD&amount=200');
        $response->assertStatus(200);
    }
}
