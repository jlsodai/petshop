<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\OrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;

class OrderController extends Controller
{
    public function create(OrderRequest $request)
    {
        $order_status = OrderStatus::where('uuid', $request->order_status_uuid)->first();
        $payment = Payment::where('uuid', $request->payment_uuid)->first();

        $amount = 0;

        foreach ($request->products as $product) {
            $product_model = Product::where('uuid', $product['uuid'])->first();
            $amount += $product_model->price * $product['qty'];
        }

        $order = Order::create([
            "order_status_id" => $order_status->id,
            "user_id" => auth()->user()->id,
            "payment_id" => $payment->id,
            "address" => $request->address,
            "products" => $request->products,
            "amount" => $amount
        ]);

        // Generate Stripe Checkout XXX

        return response($order);
    }

//    public function payment(Order $order)
//    {
//        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
//
//        $base_url = env('APP_URL') . '/payment/' . $order->uuid;
//        $line_items = [];
//
//
//        foreach ($order->products as $product) {
//
//            $product_model = Product::where('uuid', $product['uuid'])->first();
//
//            $line_items[] = [
//                'price_data' => [
//                    'currency' => 'eur',
//                    'product_data' => [
//                        'name' => $product_model->title,
//                    ],
//                    'unit_amount' => (int) $product_model->price * 100,
//                ],
//                'quantity' => 1,
//            ];
//        }
//
//        $checkout_session = \Stripe\Checkout\Session::create([
//            'line_items' => [$line_items],
//            'mode' => 'payment',
//            'success_url' => $base_url . '/?status=success&gtw=stripe',
//            'cancel_url' => $base_url . '/?status=failure&gtw=stripe',
//        ]);
//
//        return response([
//            "checkout_url" => $checkout_session->url
//        ]);
//    }
}
