<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'present', 'min:1'],
            'contract_id' => ['required', 'present', 'min:1' ]
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Informe o usuário contratante',
            'contract_id.required' => 'Informe o contrato',
        ];
    }
}
