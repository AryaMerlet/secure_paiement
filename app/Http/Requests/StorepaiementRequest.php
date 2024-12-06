<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorepaiementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        $paiement = $this->route('paiement');

        return [
            'price' => ['required', 'numeric', 'min:0'],
            'user_id' => ['required', 'exists:users,id'],
            'card_id' => ['required', 'exists:cards,id'],
        ];
    }
}
