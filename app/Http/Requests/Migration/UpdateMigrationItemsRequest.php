<?php

namespace App\Http\Requests\Migration;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMigrationItemsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('auth-api')->check();
    }

    public function rules(): array
    {
        return [
            'selected_item_ids' => 'present|array',
            'selected_item_ids.*' => 'integer',
        ];
    }

    public function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()->messages()], 422));
    }
}
