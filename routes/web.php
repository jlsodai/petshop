<?php

use Illuminate\Support\Facades\Route;
use Stripe\Stripe;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('stripetest', function() {
    Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    $base_url = 'http://petshop.devt/api/v1/payment/123123123123123123/';

    $checkout_session = \Stripe\Checkout\Session::create([
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'T-shirt',
                ],
                'unit_amount' => 2000,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => $base_url . '?status=success&gtw=stripe',
        'cancel_url' => $base_url . '?status=failure&gtw=stripe',
    ]);

    return redirect($checkout_session->url);
});
