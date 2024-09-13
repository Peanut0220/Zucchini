<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => [
                'required',
                'regex:/^(\+60|0)[1-9][0-9]{8,11}$/', // Malaysian phone number format
                'max:15',
            ],
            'street_address' => 'required|string|max:255',
            'rider' => 'required|string|in:FoodPanda,Grab,ShopeeFood',
            'payment_method' => 'required|string|in:CC,COD,EW',
        ];

        // Add credit card fields only if the payment method is 'credit_card'
        if ($this->input('payment_method') === 'CC') {
            $rules['card_name'] = 'required|string|max:255';
            $rules['card_number'] = 'required|numeric|digits_between:13,19';
            $rules['expiration_date'] = 'required|date_format:m/y';
            $rules['cvv'] = 'required|numeric|digits:3';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'The phone number must be a valid Malaysian phone number.',
            'card_number.digits_between' => 'The card number must be between 13 and 19 digits.',
            'expiration_date.date_format' => 'The expiration date must be in the format MM/YY.',
            'cvv.digits' => 'The CVV must be 3 digits.',
        ];
    }
}
