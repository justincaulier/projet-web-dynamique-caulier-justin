<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Enums\UserRole;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Searchable;

    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'surname',
        'address_id', // ⚡ important : FK vers adresses
        'email',
        'email_verified_at',
        'password',
        'provider',
        'provider_id',
        'google_id',
        'tva',
        'telephone',
        'login_attempts',
        'language',
        'website',
        'role',
        'is_banned',
        'registered_at',
        'registration_confirmed',
        'newsletter'
    ];

    // Relation avec la table adresse
    public function address(): BelongsTo
    {
        return $this->belongsTo(Adresse::class, 'address_id');
    }

    // Relation avec la table pivot categories
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'category_providers',
            'user_id',
            'category_id'
        );
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'role' => UserRole::class,
        'email_verified_at' => 'datetime',
        'is_banned' => 'boolean',
        'registration_confirmed' => 'boolean',
        'newsletter' => 'boolean',
    ];
}
