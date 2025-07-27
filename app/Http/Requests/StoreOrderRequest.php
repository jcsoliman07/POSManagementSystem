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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'orderData' => 'required|json',
            'paymentMethod' => 'required|string',
            'customerName'  => 'required|string',
        ];
    }

    public function messages(){
        return [
            'orderData.required'     => 'The order data is required.',
            'orderData.json'         => 'The order data must be a valid JSON string.',
            'paymentMethod.required' => 'Please select a payment method.',
            'paymentMethod.string'   => 'Payment method must be a string.',
            'customerName.required'  => 'Customer name is required.',
            'customerName.string'    => 'Customer name must be a valid string.',
        ];
    }
}
