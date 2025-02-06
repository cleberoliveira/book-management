<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('books', BookController::class);
});

Route::resource('books', BookController::class)->only(['index', 'show']);