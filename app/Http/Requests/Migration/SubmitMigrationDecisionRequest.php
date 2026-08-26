<?php

namespace App\Http\Requests\Migration;

use App\Models\MigrationCase;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SubmitMigrationDecisionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('auth-api')->check();
    }

    public function rules(): array
    {
        return [
            'decision' => ['required', Rule::in([
                MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS,
                MigrationCase::STATUS_CONSENT_ACCOUNT_ONLY,
                MigrationCase::STATUS_DECLINED_KEEP_RELOVED,
                MigrationCase::STATUS_DELETE_REQUESTED,
            ])],
            'acknowledged' => 'accepted',
        ];
    }

    public function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()->messages()], 422));
    }
}
