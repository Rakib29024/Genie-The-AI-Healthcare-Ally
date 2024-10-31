<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorAppointmentController;
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
    Route::get('/appointments', [DoctorAppointmentController::class, 'index'])->name('appointments');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
