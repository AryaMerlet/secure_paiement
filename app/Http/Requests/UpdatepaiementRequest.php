<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatepaiementRequest extends FormRequest
{
    /**
     * Summary of authorize
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Summary of rules
     * @return string[][]
     */
    public function rules()
    {
        $paiement = $this->route('paiement');

        return [
            'refund_amount' => [
                'required',
                'numeric',
                'min:0',
                'max:' . ($paiement->price - $paiement->refunded_amount),
            ],
        ];
    }
    /**
     * Summary of messages
     * @return string[]
     */
    public function messages()
    {
        return [
            'refund_amount.max' => 'The refund amount cannot exceed the remaining amount to be refunded.',
        ];
    }
}
