<?php

namespace app\Repositories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserRepository extends BaseRepository
{
    public function index():Collection {
        return User::all();
    }
    public function show(int $id, array $relations = []):User{
        return User::findOrFail($id);
    }
    public function search(Request $request,int $id):Collection{
    $users = User::search()
    }

}

