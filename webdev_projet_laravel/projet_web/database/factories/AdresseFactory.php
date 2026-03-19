<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdresseFactory extends Factory
{
    public function definition(): array
    {
        $cities = [

            'Liège' => [
                'postcode' => '4000',
                'streets' => [
                    'Rue Saint-Gilles',
                    'Rue Pont d’Avroy',
                    'Rue de la Cathédrale',
                    'Boulevard d’Avroy'
                ],
                'lat' => 50.6333,
                'lon' => 5.5675
            ],

            'Namur' => [
                'postcode' => '5000',
                'streets' => [
                    'Rue de Fer',
                    'Rue de Bruxelles',
                    'Rue Saint-Joseph',
                    'Avenue Reine Astrid'
                ],
                'lat' => 50.4669,
                'lon' => 4.8674
            ],

            'Charleroi' => [
                'postcode' => '6000',
                'streets' => [
                    'Boulevard Tirou',
                    'Rue de la Montagne',
                    'Rue de Dampremy',
                    'Avenue Mascaux'
                ],
                'lat' => 50.4108,
                'lon' => 4.4446
            ],

            'Bruxelles' => [
                'postcode' => '1000',
                'streets' => [
                    'Rue Neuve',
                    'Rue de la Loi',
                    'Boulevard Anspach',
                    'Rue Royale'
                ],
                'lat' => 50.8503,
                'lon' => 4.3517
            ],

            'Wavre' => [
                'postcode' => '1300',
                'streets' => [
                    'Rue du Commerce',
                    'Chaussée de Louvain',
                    'Rue de Namur',
                    'Avenue Pasteur'
                ],
                'lat' => 50.7172,
                'lon' => 4.6117
            ],

            'Mons' => [
                'postcode' => '7000',
                'streets' => [
                    'Rue de Nimy',
                    'Rue d’Havré',
                    'Rue des Fripiers',
                    'Rue de la Chaussée'
                ],
                'lat' => 50.4542,
                'lon' => 3.9523
            ],
        ];

        $city = $this->faker->randomElement(array_keys($cities));
        $cityData = $cities[$city];

        return [
            'street' => $this->faker->randomElement($cityData['streets']),
            'number' => (string) $this->faker->numberBetween(1, 200),
            'city' => $city,
            'postcode' => $cityData['postcode'],
            'country' => 'Belgique',
            'box' => $this->faker->optional()->bothify('##'),

            // coordonnées autour de la ville
            'lat' => $this->faker->latitude($cityData['lat'] - 0.02, $cityData['lat'] + 0.02),
            'lon' => $this->faker->longitude($cityData['lon'] - 0.02, $cityData['lon'] + 0.02),
        ];
    }
}
