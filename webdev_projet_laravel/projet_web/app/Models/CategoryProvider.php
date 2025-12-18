<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryProvider extends Model
{
    protected $table = 'category_providers';
    //Relation avec la table catégorie
    public function category():BelongsToMany {
    return $this->belongsToMany(Category::class);
    }
    //Relation avec la table utilisateur
    public function user():BelongsToMany {
        return $this->belongsToMany(User::class);
    }

}
