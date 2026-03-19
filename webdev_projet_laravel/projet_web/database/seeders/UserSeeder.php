<?php

namespace Database\Seeders;

use App\Models\Adresse;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ⚡ Récupère toutes les catégories existantes
        $categories = Category::all();

        // Crée 10 providers
        User::factory()->count(20)->create()->each(function (User $user) use ($categories) {

            // 1 Associer une adresse
            $user->address()->associate(Adresse::factory()->create());

            // 2️ Définir le rôle PROVIDER
            $user->role = 'PROVIDER';

            $user->save();

            // 3️ Associer au moins 1 catégorie (1 ou 2 aléatoires)
            $user->categories()->attach(
                $categories->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
