<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
class Adresse extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    public $timestamps = false;
    protected $table = 'adresses';
    protected $fillable = [
        'street',
        'number',
        'city',
        'postcode',
        'country',
        'box'
    ];
    //Relation avec la table user
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'address_id');
    }

}
