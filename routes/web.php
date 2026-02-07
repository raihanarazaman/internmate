<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AiController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\NotificationController;




// Public pages
Route::get('/', function () {
    return view('welcome');
});

// Custom Auth
Route::get('/login', [App\Http\Controllers\Auth\SimpleAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\SimpleAuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\SimpleAuthController::class, 'logout'])->name('logout');

// Custom Registration
Route::get('/register', [App\Http\Controllers\Auth\CustomRegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\CustomRegisteredUserController::class, 'store']);

// Profile Updates
Route::put('/student/profile', [App\Http\Controllers\Student\DashboardController::class, 'updateProfile'])->name('student.update');
Route::put('/company/profile', [App\Http\Controllers\Company\DashboardController::class, 'updateProfile'])->name('company.update');

// Internships
Route::post('/internships', [App\Http\Controllers\Company\DashboardController::class, 'storeInternship'])->name('internships.store');

// Applications
Route::put('/applications/{application}', [App\Http\Controllers\Company\DashboardController::class, 'updateApplication'])->name('applications.update');
Route::delete('/applications/{application}', [App\Http\Controllers\Company\DashboardController::class, 'destroyApplication'])->name('applications.destroy');
Route::post('/applications/student', [App\Http\Controllers\Student\DashboardController::class, 'apply'])->name('applications.student.store');

// Dashboards
Route::get('/student/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
Route::get('/company/dashboard', [App\Http\Controllers\Company\DashboardController::class, 'index'])->name('company.dashboard');

// Student profile VIEW (GET)
Route::get('/student/profile', [App\Http\Controllers\Student\DashboardController::class, 'showProfile'])->name('student.profile');

// Student profile UPDATE (PUT)
Route::put('/student/profile', [App\Http\Controllers\Student\DashboardController::class, 'updateProfile'])->name('student.update');


Route::post('/ai/chat', [AiController::class, 'chat'])->name('ai.chat');


// Add this line
Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');

Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
    ->name('notifications.mark-read');