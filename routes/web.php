<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorAppointmentController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProblemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/category-to-problems', [DashboardController::class, 'categoryToProblems'])->name('category-to-problems');
    Route::post('/health-issue-info', [DashboardController::class, 'healthIssueInfoStore'])->name('health-issue-info.store');
    Route::post('/ai-format', [DashboardController::class, 'aiFormat'])->name('ai-format');
    Route::post('/ai-chat', [DashboardController::class, 'aiChat'])->name('ai-chat');

    Route::get('/user-problem', [UserProblemController::class, 'index'])->name('user-problem');
    Route::get('/user-problem/{id}', [UserProblemController::class, 'details'])->name('user-problem.details');

    Route::post('/appointments/{user_problem_id?}', [DoctorAppointmentController::class, 'index'])->name('appointments');
    Route::post('/appointment/store', [DoctorAppointmentController::class, 'store'])->name('appointment.store');

    Route::post('/foods/{user_problem_id?}', [FoodController::class, 'index'])->name('foods');
    Route::post('/food/store', [FoodController::class, 'store'])->name('food.store');

    Route::post('/medecines/{user_problem_id?}', [MedicineController::class, 'index'])->name('medecines');
    Route::post('/medicine/store', [MedicineController::class, 'store'])->name('medicine.store');

    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
