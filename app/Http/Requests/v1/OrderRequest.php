<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'order_status_uuid' => 'required|uuid|exists:order_statuses,uuid',
            'payment_uuid' => 'required|uuid|exists:payments,uuid',
            'products' => 'required|array',
            'products.*.uuid' => 'required|uuid|exists:products,uuid',
            'products.*.qty' => 'required|numeric|gt:0',
            'address' => 'required|array',
            'address.billing' => 'required|string',
            'address.shipping' => 'required|string',
        ];
    }
}
