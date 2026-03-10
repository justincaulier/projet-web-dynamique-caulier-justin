<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private UserRepository $userRepository
    ) {}

    public function index(): View|JsonResponse
    {
        try {
            $query = request('search', '');

            $categories = $this->categoryRepository->getAll();

            $users = $this->userRepository->search($query, 3);

            $sliderImages = [
                'bienetre1.jpg',
                'bienetre2.jpg',
                'bienetre3.jpg',
            ];

            return view('home', compact(
                'categories',
                'sliderImages',
                'users',
                'query'
            ));

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
    }

    public function show(int $id): View|JsonResponse
    {
        try {
            $category = $this->categoryRepository->findById($id);

            $users = $this->userRepository
                ->getProvidersByCategory($category->id, 3); //  limite à 3

            return view('categories.show', compact('category', 'users'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
    }

}
