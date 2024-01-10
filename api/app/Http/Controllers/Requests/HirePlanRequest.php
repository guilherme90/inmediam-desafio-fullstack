<?php

namespace App\Http\Controllers\Requests;

use App\Modules\User\Models\User;
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
            'user_id' => ['required', 'present', 'min:1'],
            'plan_id' => ['required', 'present', 'min:1' ],
            'price' => ['required', 'present'],
            'type_invoice' => ['required', 'present', ],
            'type_payment' => ['required', 'present', ]
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Informe o usuário contratante',
            'plan_id.required' => 'Informe o plano',
            'price.required' => 'Informe o valor',
            'type_invoice.required' => 'Informe o tipo de transação, crédito ou débito',
            'type_payment.required' => 'Informe qual o tipo de pagamento'
        ];
    }
}
