<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Anyone may register.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the register request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => ["required", "string", "max:255"],
            "last_name" => ["required", "string", "max:255"],
            "email" => ["required", "email", "max:255", Rule::unique("users", "email")],
            "phone_number" => ["nullable", "string", "max:30"],
            "password" => ["required", "confirmed", Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            "email.unique" => "An account with this email address already exists.",
        ];
    }
}