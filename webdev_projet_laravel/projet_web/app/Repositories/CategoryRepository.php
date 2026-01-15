<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    protected Category $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * Récupérer toutes les catégories
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Récupérer uniquement les catégories validées
     */
    public function getValidated(): Collection
    {
        return $this->model->where('is_validated', true)->get();
    }

    /**
     * Récupérer les catégories mises en avant
     */
    public function getHighlighted(): Collection
    {
        return $this->model->where('is_highlighted', true)->get();
    }

    /**
     * Trouver une catégorie par ID
     */
    public function findById(int $id): ?Category
    {
        return $this->model->findOrFail($id);
    }
}
