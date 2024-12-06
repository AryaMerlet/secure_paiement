<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCardRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:credit,debit'], 
            'number' => ['required', 'string', 'size:16', 'unique:cards,number'], 
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
            'number.size' => 'The card number must be exactly 16 digits.',
            'number.unique' => 'This card number has already been used.',
            'expiration_date.after' => 'The expiration date must be in the future.',
            'code.digits' => 'The CVV code must be exactly 3 digits.',
        ];
    }
}
