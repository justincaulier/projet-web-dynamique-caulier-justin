<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Liste complète des providers (sans pagination).
     */
    public function index(int $perPage = 3)
    {
        return $this->model
            ->where('role', 'PROVIDER')
            ->with('address', 'categories')
            ->orderBy('name', 'asc')
            ->paginate($perPage);
    }

    /**
     * Recherche des providers par nom, ville, code postal ou catégorie, avec pagination.
     */
    public function search(?string $query = null, int $perPage = 10): LengthAwarePaginator
    {
        $builder = $this->baseProviderQuery();

        if (!empty($query)) {
            $builder->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhereHas('address', fn($q2) =>
                    $q2->where('city', 'LIKE', "%{$query}%")
                        ->orWhere('postcode', 'LIKE', "%{$query}%")
                    )
                    ->orWhereHas('categories', fn($q3) =>
                    $q3->where('name', 'LIKE', "%{$query}%")
                    );
            });
        }

        return $builder->paginate($perPage)->withQueryString();
    }

    /**
     * Liste des providers d'une catégorie, avec pagination.
     */
    public function getProvidersByCategory(int $categoryId, int $perPage = 3): LengthAwarePaginator
    {
        return $this->baseProviderQuery()
            ->whereHas('categories', fn($q) => $q->where('id', $categoryId))
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Query de base pour les providers (avec relations et tri alphabétique)
     */
    private function baseProviderQuery()
    {
        return $this->model
            ->where('role', 'PROVIDER')
            ->with('address', 'categories')
            ->orderBy('name', 'asc');
    }

    // Méthodes CRUD classiques
    public function show(int $id, array $relations = []): User
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    public function create(array $data): User
    {
        return $this->model::create($data);
    }

    public function update(int $id, array $data): User
    {
        $user = $this->show($id);
        $user->update($data);
        return $user->fresh();
    }

    public function delete(int $id): void
    {
        $user = $this->show($id);
        $user->delete();
    }
}
