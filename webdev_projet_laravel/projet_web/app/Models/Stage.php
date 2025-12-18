<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $table = 'stages';
    protected $fillable = [
        'name',
        'description',
        'date_start',
        'date_end',
        'date_publication_start',
        'date_publication_end',
        'price',
        'informations_complementary'
    ];
}
