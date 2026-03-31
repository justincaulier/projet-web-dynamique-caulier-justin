<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\RegistrationCompletionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Page d'accueil (home)
Route::get('/', [CategoryController::class, 'index'])->name('home');

// Users
Route::prefix('user')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    //  AFFICHER le formulaire
    Route::get('/create', [UserController::class, 'create'])->name('user.create');

    //  TRAITER le formulaire
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    //Afficher 1 user
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
});

// Catégories
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Auth Google
Route::prefix('auth/google')->group(function () {
    Route::get('/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
    Route::get('/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');
});

// Complétion de l’inscription via email
Route::get('/complete-registration/{id}', [RegistrationCompletionController::class, 'show'])
    ->name('registration.complete');

Route::post('/complete-registration/{id}', [RegistrationCompletionController::class, 'store']);

//Route pour se connecter et se déconnecter
Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
