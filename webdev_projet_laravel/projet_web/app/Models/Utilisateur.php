<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Utilisateur extends Model
{
    public $table = 'utilisateurs';
    public $timestamps = false;
    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'email',
        'password',
        'tva',
        'telephone mobile',
        'nombre tentatives connexion',
        'langue',
        'site web',
        'rôle',
        'date inscription',
        'inscription confirmation',
    ];

}
