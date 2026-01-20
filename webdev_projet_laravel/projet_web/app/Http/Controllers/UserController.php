<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    protected UserRepository $userRepo;
    protected CategoryRepository $categoryRepo;

    public function __construct(UserRepository $userRepo, CategoryRepository $categoryRepo)
    {
        $this->userRepo = $userRepo;
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Liste complète des providers (sans recherche).
     */
    public function index(Request $request)
    {
        $users = $this->userRepo->index(3); // ✔ paginator
        $categories = $this->categoryRepo->getAll();
        $sliderImages = ['bienetre1.jpg','bienetre2.jpg','bienetre3.jpg'];
        $query = '';

        return view('home', compact('users','categories','sliderImages','query'));
    }



    /**
     * Recherche des providers avec pagination
     */
    public function search(Request $request): View
    {
        $query = $request->input('search', '');
        $perPage = 3;

        $users = $this->userRepo->search($query, $perPage);
        $categories = $this->categoryRepo->getAll();
        $sliderImages = ['bienetre1.jpg','bienetre2.jpg','bienetre3.jpg'];

        return view('home', compact('users','categories','sliderImages','query'));
    }

    /**
     * Affiche les providers d'une catégorie
     */
    public function showByCategory(int $categoryId): View
    {
        $users = $this->userRepo->getProvidersByCategory($categoryId, 3);
        $categories = $this->categoryRepo->getAll();
        $sliderImages = ['bienetre1.jpg','bienetre2.jpg','bienetre3.jpg'];

        $category = $this->categoryRepo->findById($categoryId);

        $query = $category->name;

        return view('home', compact('users','categories','sliderImages','query'));
    }

    /**
     * Affiche un provider
     */
    public function show(int $id): View
    {
        $user = $this->userRepo->show($id, ['address','categories']);
        return view('users.show', compact('user'));
    }
}
