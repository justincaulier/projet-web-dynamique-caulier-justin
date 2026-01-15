<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {

        $this->categoryRepository = $categoryRepository;
    }

    public function index(): View|JsonResponse
    {
        try {
            $categories = app(CategoryRepository::class)->getAll();

            // Slider dynamique depuis public/images
            $sliderImages = [
                'bienetre1.jpg',
                'bienetre2.jpg',
                'bienetre3.jpg',
            ];

            return view('home', compact('categories', 'sliderImages'));
        }catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }

    }
    public function show(int $id):View|JsonResponse
    {
        try {
            $category = $this->categoryRepository->findById($id);

            return view('categories.show', compact('category'));
        }catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }

    }
}
