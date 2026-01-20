<?php

namespace Database\Seeders;

use App\Models\Adresse;
use Illuminate\Database\Seeder;

class AdresseSeeder extends Seeder
{
    public function run(): void
    {
        Adresse::factory()->count(10)->create();
    }
}
