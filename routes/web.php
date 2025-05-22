<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gestion des utilisateurs
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    
    // Gestion des programmes
    Route::prefix('programs')->group(function () {
        Route::get('/', [ProgramController::class, 'index'])->name('programs.index');
        Route::get('/create', [ProgramController::class, 'create'])->name('programs.create');
        Route::post('/', [ProgramController::class, 'store'])->name('programs.store');
        Route::get('/{program}', [ProgramController::class, 'show'])->name('programs.show');
        Route::get('/{program}/edit', [ProgramController::class, 'edit'])->name('programs.edit');
        Route::put('/{program}', [ProgramController::class, 'update'])->name('programs.update');
        Route::delete('/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');
        
        // Catégories de programmes
        Route::get('/categories', [ProgramController::class, 'categories'])->name('programs.categories');
        Route::post('/categories', [ProgramController::class, 'storeCategory'])->name('programs.categories.store');
    });
    
    // Gestion des exercices
    Route::prefix('exercises')->group(function () {
        Route::get('/', [ExerciseController::class, 'index'])->name('exercises.index');
        Route::get('/create', [ExerciseController::class, 'create'])->name('exercises.create');
        Route::post('/', [ExerciseController::class, 'store'])->name('exercises.store');
        Route::get('/{exercise}', [ExerciseController::class, 'show'])->name('exercises.show');
        Route::get('/{exercise}/edit', [ExerciseController::class, 'edit'])->name('exercises.edit');
        Route::put('/{exercise}', [ExerciseController::class, 'update'])->name('exercises.update');
        Route::delete('/{exercise}', [ExerciseController::class, 'destroy'])->name('exercises.destroy');
        
        // Catégories d'exercices
        Route::get('/categories', [ExerciseController::class, 'categories'])->name('exercises.categories');
        Route::post('/categories', [ExerciseController::class, 'storeCategory'])->name('exercises.categories.store');
    });
    
    // Gestion de la nutrition
    Route::prefix('nutrition')->group(function () {
        Route::get('/plans', [NutritionController::class, 'plans'])->name('nutrition.plans');
        Route::get('/recipes', [NutritionController::class, 'recipes'])->name('nutrition.recipes');
    });
    
    // Gestion des abonnements
    Route::prefix('subscriptions')->group(function () {
        Route::get('/plans', [SubscriptionController::class, 'plans'])->name('subscriptions.plans');
        Route::get('/payments', [SubscriptionController::class, 'payments'])->name('subscriptions.payments');
    });
    
    // Statistiques
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');
    
    // Paramètres
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    
    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';