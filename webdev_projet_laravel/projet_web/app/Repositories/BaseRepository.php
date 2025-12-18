<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{

    public Model $model;
    public function __construct(Model $model){
        $this->model = $model;
    }
    public function index(): Collection{
        return $this->model::all();
    }
    public function show(int $id, array $relations = []): Model{
        return $this->model::with($relations)->findOrFail($id);
    }
    public function delete(int $id): void {
        $model = $this->show($id);
        $model->delete();
    }
    public function create(array $args): Model{
        return $this->model::create($args);
    }
    public function update(int $id, array $args): Model {
        $type = $this->show($id);
        $type->update($args);
        return $this->model->fresh();
    }
}
