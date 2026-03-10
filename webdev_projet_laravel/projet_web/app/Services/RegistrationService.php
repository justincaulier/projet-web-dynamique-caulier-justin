<?php
namespace App\Services;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Adresse;

class RegistrationService
{
    /**
     * Complète l'inscription d'un utilisateur.
     */
    public function completeRegistration(User $user, array $data): User
    {
        // ⚡ Champs de base
        $user->name = $data['name'];
        $user->surname = $data['surname'] ?? null;
        $user->registration_confirmed = true;

        // ⚡ Si l'utilisateur coche "Je suis un prestataire"
        if (!empty($data['is_provider'])) {

            $user->role = UserRole::PROVIDER; // Enum
            $user->description = $data['description'] ?? null;
            $user->tva = $data['tva'] ?? null;
            $user->website = $data['website'] ?? null;
            $user->telephone = $data['telephone'] ?? null;

            // ⚡ Adresse
            if (!empty($data['street']) && !empty($data['city'])) {
                $adresse = Adresse::create([
                    'street'   => $data['street'],
                    'number'   => $data['number'] ?? null,
                    'box'      => $data['box'] ?? null,
                    'city'     => $data['city'],
                    'postcode' => $data['postcode'] ?? null,
                    'country'  => $data['country'] ?? null,
                ]);

                // ⚡ Lie l'adresse à l'utilisateur
                $user->address()->associate($adresse);
            }

            // ⚡ Photo / avatar
            if (!empty($data['photo'])) {
                $user->avatar = $data['photo']->store('providers_photos', 'public');
            }
        }

        $user->save();

        return $user->fresh();
    }
}
