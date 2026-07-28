<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\FitnessActivityController;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware([Authenticate::class, EnsureEmailIsVerified::class])->name('dashboard');

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['put', 'patch'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/meals', [MealController::class, 'index'])->name('meals.index');
    Route::match(['get', 'post'], '/meals/log-plan/{planFoodId}', [MealController::class, 'logFromPlan'])->name('meals.log.plan');
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

    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('/plans/custom/create', [PlanController::class, 'createCustom'])->name('plans.custom.create');
    Route::post('/plans/custom/store', [PlanController::class, 'storeCustom'])->name('plans.custom.store');
    Route::get('/plans/{id}/edit-days', [PlanController::class, 'editDays'])->name('plans.edit.days');
    Route::match(['put', 'post'], '/plans/day/{dayId}/update', [PlanController::class, 'updateDayRow'])->name('plans.day.update');
    Route::post('/plans/{id}/enroll', [PlanController::class, 'enroll'])->name('plans.enroll');
    Route::delete('/plans/custom/{id}', [PlanController::class, 'destroy'])->name('plans.custom.destroy');
    Route::post('/plans/day/{dayId}/add-food', [PlanController::class, 'addFoodToDay'])->name('plans.day.addFood');
    Route::delete('/plans/day-food/{itemId}', [PlanController::class, 'removeFoodFromDay'])->name('plans.day.removeFood');
});

require __DIR__ . '/auth.php';
