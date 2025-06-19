<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// Categories
Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class, 'index'])->middleware('auth:sanctum');
