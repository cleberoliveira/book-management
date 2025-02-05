<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('books', BookController::class)->except(['index', 'show']);
});

Route::resource('books', BookController::class)->only(['index', 'show']);