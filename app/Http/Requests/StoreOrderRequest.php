<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => [
                'required',
                'regex:/^(\+60|0)[1-9][0-9]{8,11}$/', // Malaysian phone number format
                'max:15',
            ],
            'street_address' => 'required|string|max:255',
            'rider' => 'required|string',
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|numeric|digits_between:13,19',
            'expiration_date' => 'required|date_format:m/y',
            'cvv' => 'required|numeric|digits:3',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array<string, string>
     */
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
