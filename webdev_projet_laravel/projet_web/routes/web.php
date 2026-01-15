<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/search', [UserController::class, 'search'])->name('user.search');
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show');

});
//Route pour afficher les différentes catégories sur la page home
Route::get('/', [CategoryController::class, 'index'])->name('home');
// Page d'une catégorie
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

//Route pour l'authentification google
Route::prefix('auth')->group(function(){
    Route::prefix('google')->group(function(){
        Route::get('/callback')->name('google.callback');
        Route::get('/redirect')->name('google.redirect');
    });
});
