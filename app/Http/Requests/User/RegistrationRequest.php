<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistrationRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|unique:users,mobile_number',
            'password' => 'required|confirmed|min:6|max:25'
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
        $response = response()->json(['message' => $errors->messages()], 200);
        throw new HttpResponseException($response);
    }
}
