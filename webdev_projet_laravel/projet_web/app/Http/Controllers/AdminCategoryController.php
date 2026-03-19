<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{

    public function __construct(
        private CategoryRepository $categoryRepo,
        private UserRepository $userRepo
    ) {}

    public function index(): View
    {
        try {

            $categories = $this->categoryRepo->index();

            return view('admin.categories.index', compact('categories'));

        } catch (\Exception $e) {

            abort(500);
        }
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        try {

            $this->categoryRepo->create($request->validated());

            return redirect()
                ->route('categories.index')
                ->with('success', 'Catégorie créée.');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la création.');
        }
    }

    public function edit(int $id): View
    {
        try {

            $category = $this->categoryRepo->show($id);

            return view('admin.categories.edit', compact('category'));

        } catch (\Exception $e) {

            abort(404);
        }
    }

    public function update(CategoryRequest $request, int $id): RedirectResponse
    {
        try {

            $this->categoryRepo->update($id, $request->validated());

            return redirect()
                ->route('categories.index')
                ->with('success', 'Catégorie modifiée.');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la modification.');
        }
    }

    public function destroy(DeleteCategoryRequest $request, int $id): RedirectResponse
    {
        try {

            $newCategoryId = $request->input('transfer_category');

            $this->categoryRepository->deleteAndTransferProviders(
                $id,
                $newCategoryId
            );

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Catégorie supprimée et prestataires transférés.');

        } catch (\Exception $e) {

            return back()->with('error', 'Erreur lors de la suppression.');
        }
    }
}
