<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Récupérer uniquement les catégories validées
     */
    public function getValidated(): Collection
    {
        return $this->model
            ->where('is_validated', true)
            ->get();
    }

    /**
     * Récupérer les catégories mises en avant
     */
    public function getHighlighted(): Collection
    {
        return $this->model
            ->where('is_highlighted', true)
            ->get();
    }
    public function deleteAndTransferProviders(int $categoryId, int $newCategoryId): void
    {
        DB::transaction(function () use ($categoryId, $newCategoryId) {

            $category = $this->show($categoryId, ['users']);

            foreach ($category->users as $user) {

                // retirer ancienne catégorie
                $user->categories()->detach($categoryId);

                // ajouter nouvelle catégorie
                $user->categories()->syncWithoutDetaching([$newCategoryId]);
            }

            // supprimer catégorie
            $category->delete();
        });
    }
}
