<?php

namespace app\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{
    public function index():Collection {
        return User::all();
    }
    public function show(int $id, array $relations = []):User{
        return User::findOrFail($id);
    }
}
