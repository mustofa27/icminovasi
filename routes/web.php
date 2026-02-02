<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\TestimonialController;

// Public Routes
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/projects/{project:slug}', [LandingController::class, 'showProject'])->name('projects.show');
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes - Content Management (Admin & Editor)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'content.manage'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Projects Management
    Route::resource('projects', ProjectController::class);
    
    // Clients Management
    Route::resource('clients', ClientController::class);

    // Testimonials Management
    Route::resource('testimonials', TestimonialController::class);

    // General Settings
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Inquiries
    Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
    Route::put('/inquiries/{inquiry}', [AdminInquiryController::class, 'update'])->name('inquiries.update');
});

// Admin Routes - User Management (Admin Only)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
});


