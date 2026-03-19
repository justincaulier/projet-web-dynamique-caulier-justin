<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Adresse;
use App\Services\GeoService;

class RegistrationService
{
    private GeoService $geoService;

    public function __construct(GeoService $geoService)
    {
        $this->geoService = $geoService;
    }

    /**
     * Complète l'inscription d'un utilisateur.
     */
    public function completeRegistration(User $user, array $data): User
    {
        // Champs de base
        $user->name = $data['name'];
        $user->surname = $data['surname'] ?? null;
        $user->registration_confirmed = true;

        // Si l'utilisateur coche "Je suis un prestataire"
        if (!empty($data['is_provider'])) {

            $user->role = UserRole::PROVIDER;
            $user->description = $data['description'] ?? null;
            $user->tva = $data['tva'] ?? null;
            $user->website = $data['website'] ?? null;
            $user->telephone = $data['telephone'] ?? null;

            // Adresse
            if (!empty($data['street']) && !empty($data['city'])) {

                // 🔹 Récupération coordonnées GPS
                $gps = $this->geoService->getGpsCoordinatesByAddress($data);

                $adresse = Adresse::create([
                    'street'   => $data['street'],
                    'number'   => $data['number'] ?? null,
                    'box'      => $data['box'] ?? null,
                    'city'     => $data['city'],
                    'postcode' => $data['postcode'] ?? null,
                    'country'  => $data['country'] ?? null,
                ]);
                // récupération GPS
                $gps = app(GeoService::class)
                    ->getGpsCoordinatesByAddress($adresse->toArray());

                if(!empty($gps)){

                    $adresse->lat = $gps['lat'];
                    $adresse->lon = $gps['lon'];
                    $adresse->save();

                }

                // Lie l'adresse à l'utilisateur
                $user->address()->associate($adresse);
            }

            // Photo / avatar
            if (!empty($data['photo'])) {
                $user->avatar = $data['photo']->store('providers_photos', 'public');
            }
        }

        $user->save();

        return $user->fresh();
    }
}
