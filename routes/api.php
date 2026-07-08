<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProfileController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'storeOrUpdate']); // Create or Update
});
