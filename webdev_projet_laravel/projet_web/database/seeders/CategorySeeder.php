<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Massage', 'description' => 'Services de massage relaxant, thérapeutique et bien-être.'],
            ['name' => 'Acupuncture', 'description' => 'Séances d’acupuncture pour équilibrer le corps et l’esprit.'],
            ['name' => 'Coiffeur', 'description' => 'Services de coiffure, coupe, coloration et soin des cheveux.'],
            ['name' => 'Wellness', 'description' => 'Activités et conseils pour le bien-être général et la santé.'],
            ['name' => 'Barbier', 'description' => 'Service pour entretenir sa barbe.'],
            ['name' => 'Spa', 'description' => 'Activités de détente : Spa, Sauna, Jaccuzzi'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
