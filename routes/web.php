<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\FitnessActivityController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/meals', [MealController::class, 'index'])->name('meals.index');
    Route::post('/meals', [MealController::class, 'store'])->name('meals.store');
    Route::delete('/meals/{id}', [MealController::class, 'destroy'])->name('meals.destroy');

    Route::get('/fitness', [FitnessActivityController::class, 'index'])->name('fitness.index');
    Route::post('/fitness/water', [FitnessActivityController::class, 'updateWater'])->name('fitness.water.update');
    Route::post('/fitness/exercise', [FitnessActivityController::class, 'storeExercise'])->name('fitness.exercise.store');
    Route::delete('/fitness/exercise/{id}', [FitnessActivityController::class, 'destroyExercise'])->name('fitness.exercise.destroy');

    Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist.index');
    Route::post('/checklist/complete', [ChecklistController::class, 'completeDay'])->name('checklist.complete');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-csv', [ReportController::class, 'exportCsv'])->name('reports.csv');
    Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
});

require __DIR__ . '/auth.php';
