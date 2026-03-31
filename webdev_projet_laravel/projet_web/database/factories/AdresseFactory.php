<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AdresseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street'   => $this->faker->streetName(),
            'number'   => (string) $this->faker->buildingNumber(),
            'city'     => $this->faker->city(),
            'postcode' => $this->faker->randomElement(['1000', '4000', '5000', '6000']),
            'country'  => $this->faker->country(),
            'box'      => $this->faker->optional()->bothify('##'),
        ];
    }
}
