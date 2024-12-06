<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCardRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:credit,debit'], 
            'expiration_date' => ['required', 'date', 'after:today'], 
            'code' => ['required', 'digits:3'],
        ];
    }
    /**
     * Summary of messages
     * @return array
     */
    public function messages(): array
    {
        return [
            'expiration_date.after' => 'The expiration date must be in the future.',
            'code.digits' => 'The CVV code must be exactly 3 digits.',
        ];
    }
}
