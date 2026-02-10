<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AiController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Company\CompanyApplicationController;
use App\Http\Controllers\Company\CompanyInternshipController;
use App\Http\Controllers\Company\CompanyProfileController;
use App\Http\Controllers\Company\CompanyStudentController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\StudentInternshipController;

use App\Http\Controllers\Common\NotificationController;
use App\Http\Controllers\Company\DashboardController as CompanyDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\InternshipController;

require __DIR__.'/auth.php';

// Public pages
Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboard::class, 'index'])
            ->name('dashboard');

        Route::get('/profile', [StudentDashboard::class, 'showProfile'])
            ->name('profile');

        Route::put('/profile', [StudentDashboard::class, 'updateProfile'])
            ->name('update');

        Route::post('/applications', [StudentDashboard::class, 'apply'])
            ->name('applications.store');

        Route::post('/applications/{application}/submit',[StudentDashboard::class, 'submitToAdmin'])->name('applications.submit');

        Route::get('/internships',[StudentInternshipController::class, 'index'])->name('internships.index');

        Route::get('/internships/{internship}',[StudentInternshipController::class, 'show'])->name('internships.show');

        Route::get('/student/applications',[StudentDashboard::class, 'applicationsIndex'])->name('applications.index');
    });

    Route::middleware(['auth', 'role:company'])
    ->prefix('company')
    ->name('company.')
    ->group(function () {

        Route::get('/dashboard', [CompanyDashboard::class, 'index'])
            ->name('dashboard');

        Route::get('/profile', [CompanyProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [CompanyProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('/internships', [CompanyInternshipController::class, 'index'])
            ->name('internships.index');

        Route::get('/internships/create', [CompanyInternshipController::class, 'create'])
            ->name('internships.create');

        Route::post('/internships', [CompanyInternshipController::class, 'store'])
            ->name('internships.store');

        Route::get('/internships/{internship}/edit', [CompanyInternshipController::class, 'edit'])
            ->name('internships.edit');

        Route::put('/internships/{internship}', [CompanyInternshipController::class, 'update'])
            ->name('internships.update');

        Route::delete('/internships/{internship}', [CompanyInternshipController::class, 'destroy'])
            ->name('internships.destroy');

        Route::put('/applications/{application}', [CompanyDashboard::class, 'updateApplication'])->name('applications.update');

        Route::get('/company/applications',[CompanyApplicationController::class, 'index'])->name('applications.index');

        Route::get('/students/{student}',[CompanyStudentController::class, 'show'])->name('students.show');

        Route::delete('/applications/{application}', [CompanyDashboard::class, 'destroyApplication'])
            ->name('applications.destroy');
    });

    Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');
              Route::put('/notifications/{notification}/read', 
            [AdminDashboard::class, 'markNotificationRead'])
            ->name('notifications.read');

        Route::put('/applications/{application}/approve', [AdminDashboard::class, 'approve'])
            ->name('applications.approve');

        Route::put('/applications/{application}/reject', [AdminDashboard::class, 'reject'])
            ->name('applications.reject');
               Route::get(
        'admin/internships/{internship}',
        [InternshipController::class, 'show']
    )->name('internships.show');

     Route::get(
        'admin/students/{student}',
        [AdminDashboard::class, 'showStudent']
    )->name('admin.students.show');
});

// COMPANY
Route::middleware(['auth'])->group(function () {
    Route::get(
        'company/students/{student}',
        [AdminDashboard::class, 'showStudent']
    )->name('company.students.show');
        // Add admin-only routes here later
    });

    Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    // Applications (generic)
    Route::post('/applications', [ApplicationController::class, 'store'])
        ->name('applications.store');

    // AI Chat
    Route::post('/ai/chat', [AiController::class, 'chat'])
        ->name('ai.chat');
});

