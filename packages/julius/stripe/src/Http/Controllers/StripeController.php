<?php

namespace Julius\Stripe\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function payment(Order $order)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $base_url = env('APP_URL') . '/payment/' . $order->uuid;
        $line_items = [];


        foreach ($order->products as $product) {

            $product_model = Product::where('uuid', $product['uuid'])->first();

            $line_items[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product_model->title,
                    ],
                    'unit_amount' => (int) $product_model->price * 100,
                ],
                'quantity' => 1,
            ];
        }

        $checkout_session = Session::create([
            'line_items' => [$line_items],
            'mode' => 'payment',
            'success_url' => $base_url . '/?status=success&gtw=stripe',
            'cancel_url' => $base_url . '/?status=failure&gtw=stripe',
        ]);

        return response([
            "checkout_url" => $checkout_session->url
        ]);
    }
}
