<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTransactionRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'items' => 'array|required',
            'items.*.item_id' => 'required|numeric|exists:items,id',
            'user_id' => 'required|numeric|exists:users,id',
            'seller_id' => 'required|numeric|exists:users,id',
            'items_quantity' => 'required|numeric',
            'service_fee_percentage' => 'required|numeric',
            'service_fee_amount' => 'required|numeric',
            'subtotal_amount' => 'required|numeric',
            'discount_amount_percentage' => 'nullable|numeric',
            'discount_amount' => 'nullable|numeric',
            'total_amount' => 'required|numeric'
        ];

    }

    /**
     * Failed validation return
     *
     * @return array
     */
    public function failedValidation(Validator $validator): array
    {
        $errors = $validator->errors();
        $response = response()->json(['message' => $errors->messages()], 422);
        throw new HttpResponseException($response);
    }
}
