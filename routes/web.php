<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    KostController,
    FavoriteController,
    ReviewController,
    ReportController
};

Route::get('/', function () {
    return view('welcome');


    Route::apiResource('user', UserController::class);
    Route::apiResource('kosts', KostController::class);
    Route::apiResource('favorites', FavoriteController::class)->only(['index', 'store']);
    Route::post('reviews', [ReviewController::class, 'store']);
    Route::post('reports', [ReportController::class, 'store']);
});
