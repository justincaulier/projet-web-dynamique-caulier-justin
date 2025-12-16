<?php

namespace app\Repositories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Collection;

class UtilisateurRepository
{
    public function getAll():Collection {
        return Utilisateur::all();
    }
    public function getById(int $id):Utilisateur{
        return Utilisateur::findOrFail($id);
    }
}
