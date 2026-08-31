<?php

namespace App\Http\Requests\Migration;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMigrationProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('auth-api')->check();
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required|string|max:30',
            'address' => 'required|string|max:2000',
            'gender' => 'nullable|integer|in:0,1,2',
            'date_of_birth' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'mobile_number.required' => 'Phone number is required.',
            'address.required' => 'Address is required.',
            'date_of_birth.required' => 'Date of birth is required.',
        ];
    }

    public function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()->messages()], 422));
    }
}
