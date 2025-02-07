<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthorController;

/*
 * Rotas de Autenticação
 */
Route::post('login', [AuthController::class, 'login']);

/*
 * Rotas Protegidas da API
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::middleware('is_admin')->group(function () {
        Route::apiResource('authors', AuthorController::class);
        Route::get('authors/{author}/books', [AuthorController::class, 'books']);
    });
});