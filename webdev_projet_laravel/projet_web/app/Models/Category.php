<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'is_highlighted',
        'is_validated',
    ];

    //Relation avec la table pivot
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'category_providers',
            'category_id',
            'user_id'
        );
    }
}
