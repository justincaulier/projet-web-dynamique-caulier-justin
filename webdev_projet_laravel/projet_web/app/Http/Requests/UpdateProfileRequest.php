<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\UserRole;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Les routes sont protégées par 'auth'
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'nullable|image|max:2048',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:20',
            'box' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ];

        if ($this->user()->role === UserRole::PROVIDER) {
            $rules['tva'] = 'nullable|string|max:20';
            $rules['photos.*'] = 'nullable|image|max:2048';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => "Le nom est obligatoire",
            'email.required' => "L'email est obligatoire",
            'email.email' => "L'email n'est pas valide",
            'avatar.image' => "Le fichier avatar doit être une image",
            'photos.*.image' => "Chaque photo doit être une image",
            'tva.max' => "Le numéro de TVA est trop long",
        ];
    }
}
