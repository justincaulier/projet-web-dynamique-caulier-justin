<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationCompletionController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', [CategoryController::class, 'index'])->name('home');

// Users
Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
});

// Complétion de l’inscription via email
Route::get('/complete-registration/{id}', [RegistrationCompletionController::class, 'show'])
    ->name('registration.complete');

Route::post('/complete-registration/{id}', [RegistrationCompletionController::class, 'store'])
    ->name('registration.storeComplete');

// Catégories
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Auth Google
Route::prefix('auth/google')->group(function () {
    Route::get('/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
    Route::get('/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');
});

// Auth standard
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});
//Contacter un prestataire

Route::get('/contact/provider/{id}', [ContactController::class,'showProviderForm'])
    ->name('contact.provider');

Route::post('/contact/provider/{id}', [ContactController::class,'sendProviderMessage'])
    ->name('contact.provider.send');

//Admin
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.') // préfixe pour les noms de routes
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        // Categories Admin
        Route::get('/categories', [AdminCategoryController::class, 'index'])
            ->name('categories.index'); // liste des catégories

        Route::get('/categories/create', [AdminCategoryController::class, 'create'])
            ->name('categories.create'); // formulaire création

        Route::post('/categories', [AdminCategoryController::class, 'store'])
            ->name('categories.store'); // création

        Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])
            ->name('categories.edit'); // formulaire édition

        Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])
            ->name('categories.update'); // update

        Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])
            ->name('categories.destroy'); // suppression
    });
