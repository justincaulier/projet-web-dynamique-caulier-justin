<?php

namespace App\Repositories;

use App\Models\Adresse;
use App\Models\User;

class AddressRepository
{
    public function findOrCreate(array $data)
    {
        return Adresse::firstOrCreate($data);
    }
}
