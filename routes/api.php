<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('posts/public', [PostController::class, 'public']);
    Route::get('posts/private', [PostController::class, 'private']);
    Route::apiResource('posts', PostController::class)->except('index');
});
