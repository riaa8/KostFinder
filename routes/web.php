<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    KostController,
    FavoriteController,
    ReviewController,
    ReportController
};

// Routing untuk UserController
Route::apiResource('user', UserController::class);

// Routing untuk KostController
Route::apiResource('kosts', KostController::class);

// Routing untuk FavoriteController (hanya index dan store)
Route::apiResource('favorites', FavoriteController::class)->only(['index', 'store']);

// Routing untuk ReviewController (untuk membuat review)
Route::post('reviews', [ReviewController::class, 'store']);

// Routing untuk ReportController (untuk membuat report)
Route::post('reports', [ReportController::class, 'store']);
