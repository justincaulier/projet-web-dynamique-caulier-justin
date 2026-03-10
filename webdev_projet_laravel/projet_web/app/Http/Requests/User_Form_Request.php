<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class User_Form_Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|string|email|unique:users,email",
            "password" => "required|string|min:8"|"regex:/^(?=.*[A-Za-z])(?=.*\d).+$/",
            "confirm-password" => "required|string|min:8|same:password",
        ];
    }
    public function messages(): array {
        return [
            "email.required" => "L'email est obligatoire",
            "email.unique"=>"L email existe déjà",
            "password.required" => "Le mot de passe est obligatoire",
            "password.regex" => "Le mot de passe doit contenir au moins une lettre et un chiffre",
            "confirm-password.required" => "Les mot de passes ne sont pas identiques",

        ];
    }
}
