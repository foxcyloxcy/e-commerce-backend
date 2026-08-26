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
            'mobile_number' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:2000',
            'gender' => 'nullable|integer|in:0,1,2',
            'date_of_birth' => 'nullable|date',
        ];
    }

    public function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()->messages()], 422));
    }
}
