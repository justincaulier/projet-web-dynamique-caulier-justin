<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteRegistrationRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'is_provider' => 'nullable|boolean',
        ];

        if ($this->has('is_provider')) {
            $rules = array_merge($rules, [
                'tva' => 'nullable|string|max:20',
                'telephone' => 'nullable|string|max:20',
                'website' => 'nullable|url|max:255',
                'description' => 'nullable|string|max:2000',
                'street' => 'required|string|max:255',
                'number' => 'nullable|string|max:20',
                'box' => 'nullable|string|max:20',
                'city' => 'required|string|max:100',
                'postcode' => 'nullable|string|max:20',
                'country' => 'nullable|string|max:100',
                'photo' => 'nullable|image|max:2048',
            ]);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => "Le nom est obligatoire",
            'street.required' => "La rue est obligatoire pour un prestataire",
            'city.required' => "La ville est obligatoire pour un prestataire",
            'website.url' => "Le site web n'est pas valide",
            'photo.image' => "Le fichier doit être une image",
        ];
    }
}
