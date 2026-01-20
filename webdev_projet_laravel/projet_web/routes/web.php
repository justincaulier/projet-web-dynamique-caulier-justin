<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Page d'accueil (home)
Route::get('/', [CategoryController::class, 'index'])->name('home');

// Users
Route::prefix('user')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show'); // mettre en dernier
});

// Catégories
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Auth Google
Route::prefix('auth/google')->group(function(){
    Route::get('/callback')->name('google.callback');
    Route::get('/redirect')->name('google.redirect');
});
