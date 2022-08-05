<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => 'required|in:credit_card,cash_on_delivery,bank_transfer',
            'details' => 'required|array',
            'details.holder_name' => 'required_if:type,credit_card|string',
            'details.number' => 'required_if:type,credit_card|string',
            'details.ccv' => 'required_if:type,credit_card|int|digits_between:3,4',
            'details.expire_date' => 'required_if:type,credit_card|string',
            'details.first_name' => 'required_if:type,cash_on_delivery|string',
            'details.last_name' => 'required_if:type,cash_on_delivery|string',
            'details.address' => 'required_if:type,cash_on_delivery|string',
            'details.swift' => 'required_if:type,bank_transfer|string',
            'details.iban' => 'required_if:type,bank_transfer|string',
            'details.name' => 'required_if:type,bank_transfer|string',
        ];
    }
}
