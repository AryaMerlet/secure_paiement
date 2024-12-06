<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Summary of rules
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/'],
            'password_confirmation' => ['required', 'same:password'],
            // 'captcha' => ['required', 'captcha'],
        ];
    }
    /**
     * Summary of messages
     * @return array
     */
    public function messages(): array
    {
        return [
            'password.regex' => 'The password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, and one special character.',
            // 'captcha.captcha' => 'The CAPTCHA verification failed.',
        ];
    }
}
