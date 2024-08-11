<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePasswordRequest extends FormRequest
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
            'password' => ['required', 'confirmed', 'string', 'min:6'],
            'current_password' => ['required', 'string']
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
