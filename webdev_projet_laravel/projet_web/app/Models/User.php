<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserRole;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'utilisateurs';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'surname',
        'address',
        'email',
        'email_verified_at',
        'password',
        'tva',
        'telephone',
        'login_attempts',
        'language',
        'website',
        'rôle',
        'is_banned',
        'registered_at',
        'registration_confirmed',
        'newsletter'
    ];
    //Relations avec la table adresse
    public function adresse():HasMany{
        return $this->hasMany(Adresse::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'role' => UserRole::class,
        'email_verified_at' => 'datetime',
        'is_banned' => 'boolean',
        'registration_confirmed' => 'boolean',
        'newsletter' => 'boolean',
    ];
}
