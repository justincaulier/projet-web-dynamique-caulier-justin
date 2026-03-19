<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Liste paginée des providers
     */
    /**
     * Retourne tous les utilisateurs sous forme de Collection
     * Compatible avec la signature du BaseRepository
     */
    public function index(): Collection
    {
        return $this->model->all();
    }

    /**
     * Retourne les utilisateurs paginés
     */
    public function paginate(int $perPage = 3): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }
    //Recherche user
    public function findByIdOrFail(int $id): User
    {
        return $this->model->findOrFail($id);
    }
    /**
     * Recherche par email
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model
            ->where('email', $email)
            ->first();
    }

    /**
     * Recherche OAuth
     */
    public function findByProviderAndProviderId(string $provider, string $providerId): ?User
    {
        return $this->model
            ->where('provider', $provider)
            ->where('provider_id', $providerId)
            ->first();
    }

    /**
     * Création user OAuth
     */
    public function createUserForOAuth(
        string $name,
        string $email,
        string $provider,
        string $providerId
    ): User {

        $lastGoogleId = $this->model
            ->whereNotNull('google_id')
            ->max('google_id') ?? 0;

        return $this->create([
            'name' => $name,
            'email' => $email,
            'provider' => $provider,
            'provider_id' => $providerId,
            'google_id' => $lastGoogleId + 1,
            'registered_at' => now(),
            'role' => 'USER',
        ]);
    }

    /**
     * Recherche providers (nom, ville, catégorie)
     */
    public function search(?string $query = null, int $perPage = 10): LengthAwarePaginator
    {
        $builder = $this->baseProviderQuery();

        $query = trim((string) $query);

        if ($query !== '') {

            $builder->where(function ($q) use ($query) {

                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('surname', 'LIKE', "%{$query}%")

                    ->orWhereHas('address', function ($q2) use ($query) {
                        $q2->where('city', 'LIKE', "%{$query}%")
                            ->orWhere('postcode', 'LIKE', "%{$query}%");
                    })

                    ->orWhereHas('categories', function ($q3) use ($query) {
                        $q3->where('name', 'LIKE', "%{$query}%");
                    });

            });
        }

        return $builder
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Providers par catégorie
     */
    public function getProvidersByCategory(int $categoryId, int $perPage = 3): LengthAwarePaginator
    {
        return $this->baseProviderQuery()
            ->whereHas('categories', fn($q) => $q->where('id', $categoryId))
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Query commune pour les providers
     */
    private function baseProviderQuery()
    {
        return $this->model
            ->where('role', 'PROVIDER')
            ->with(['address','categories'])
            ->orderBy('name', 'asc');
    }

}
