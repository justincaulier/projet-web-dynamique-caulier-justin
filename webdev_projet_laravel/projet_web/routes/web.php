<?php

use App\Http\Controllers\UtilisateurController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('utilisateur')->group(function(){
    Route::get('/', [UtilisateurController::class, 'index'])->name('utilisateur.index');
});
