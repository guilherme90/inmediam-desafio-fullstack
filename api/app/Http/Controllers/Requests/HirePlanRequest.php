<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HirePlanRequest extends FormRequest
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
            'user_id' => ['required', 'present', 'integer'],
            'plan_id' => ['required', 'present', 'integer'],
            'price' => ['required', 'present'],
            'type_invoice' => ['required', 'present', 'in:debit,credit'],
            'type_payment' => ['required', 'present', 'in:pix,credit_card,billet']
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Informe o usuário contratante',
            'user_id.integer' => 'Usuário inválido',
            'plan_id.required' => 'Informe o plano',
            'plan_id.integer' => 'Plano inválido',
            'price.required' => 'Informe o valor',
            'type_invoice.required' => 'Informe o tipo de transação, crédito ou débito',
            'type_payment.required' => 'Informe qual o tipo de pagamento'
        ];
    }
}
