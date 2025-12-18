<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adresse extends Model
{
    public $timestamps = false;
    protected $table = 'adresse';
    protected $fillable = [
        'street',
        'number',
        'city',
        'postcode',
        'country',
        'box'
    ];
    //Relation avec la table user
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
