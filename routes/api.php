<?php

use App\Http\Controllers\API\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::match(['post', 'put', 'patch'], '/profile', [ProfileController::class, 'storeOrUpdate']);
});
