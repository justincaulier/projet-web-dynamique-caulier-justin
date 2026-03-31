<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adresse extends Model
{
    use HasFactory;

    protected $table = 'adresses';
    public $timestamps = false;

    protected $fillable = [
        'street',
        'number',
        'city',
        'postcode',
        'country',
        'box'
    ];

    // Relation avec la table users
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'address_id');
    }
}
