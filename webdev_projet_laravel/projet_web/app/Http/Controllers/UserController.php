<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Repositories\CategoryRepository;
use app\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class UserController extends Controller
{
    public function index(): View|JsonResponse
    {
        try {
            $users = app(UserRepository::class)->index();
            return view('user.index', compact('users'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
    }
    public function show($id): View|JsonResponse
    {
        try {
            $user = app(UserRepository::class)->show($id);

            return view('users.show', compact('user'));
        }catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }

    }
    public function search(Request $request): View|JsonResponse
    {
        try {
            $sliderImages = ['bienetre1.jpg', 'bienetre2.jpg', 'bienetre2.jpg'];
            $categories = app(CategoryRepository::class)->getAll();
            $users = app(UserRepository::class)->search($request->get('search'));

            return view('home', compact('users', 'query', 'sliderImages', 'categories'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}

