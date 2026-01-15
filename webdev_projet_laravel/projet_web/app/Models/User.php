<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'surname',
        'addresses',
        'email',
        'email_verified_at',
        'password',
        'provider',
        'provider_id',
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
    //Relations avec la table adresse
    public function adresse(): BelongsTo
    {
        return $this->belongsTo(Adresse::class, 'address_id');
    }
    //Relations avec la table pivot
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'category_providers', // nom de la table pivot
            'user_id',            // FK dans la pivot vers User
            'category_id'         // FK dans la pivot vers Category
        );
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
