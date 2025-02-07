<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\AuthController as AuthControllerWeb;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('books', BookController::class);
});

Route::resource('books', BookController::class)->only(['index', 'show']);