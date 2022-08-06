<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\OrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

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
}
