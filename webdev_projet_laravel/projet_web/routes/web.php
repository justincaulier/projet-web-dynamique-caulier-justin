<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::prefix('user')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('user.index');
});
