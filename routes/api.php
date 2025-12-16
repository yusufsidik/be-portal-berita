<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController, 
    AuthorController, 
    CategoryController,
    NewsController,
    BannerController
};

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('author', AuthorController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('news', NewsController::class);
    Route::apiResource('banner', BannerController::class)->except(['update','show']);
    
});
