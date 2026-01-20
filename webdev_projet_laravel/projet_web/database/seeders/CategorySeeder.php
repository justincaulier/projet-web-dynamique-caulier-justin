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
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
