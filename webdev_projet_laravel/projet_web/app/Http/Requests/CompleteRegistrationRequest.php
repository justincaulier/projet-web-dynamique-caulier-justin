<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CompleteRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $user = $this->route('token')
            ? User::where('id', $this->route('id'))->first()
            : null;

        $rules = [
            'email' => 'required|email|max:255',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
        ];

        if ($user && $user->role === UserRole::PROVIDER) {
            $rules = array_merge($rules, [
                'description' => 'nullable|string',
                'photo' => 'nullable|image|max:2048',
                'tva' => 'nullable|string|max:50',
                'website' => 'nullable|url|max:255',
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',

                'stages' => 'nullable|array',
                'stages.*.description' => 'required_with:stages|string',
                'stages.*.price' => 'required_with:stages|numeric',
                'stages.*.start_date' => 'required_with:stages|date',
                'stages.*.end_date' => 'required_with:stages|date|after_or_equal:stages.*.start_date',
                'stages.*.info' => 'nullable|string',

                'promotions' => 'nullable|array',
                'promotions.*' => 'nullable|string',

                'password' => 'required|string|min:8|confirmed',
            ]);
        }

        return $rules;
    }
}
