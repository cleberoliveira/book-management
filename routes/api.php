<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthorController;

/*
 * Rotas de Autenticação
 */
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

/*
 * Rotas Protegidas da API para administradores
 */
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::apiResource('authors', AuthorController::class);
    Route::get('authors/{author}/books', [AuthorController::class, 'books']);
});