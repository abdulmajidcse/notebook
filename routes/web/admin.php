<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NotebookController;

/**
 * Routes before authenticate
 */
Route::middleware('guest:admin')->name('admin.')->prefix('admin')->group(function() {
    // Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    // Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

/**
 * Routes after authenticate
 */
Route::middleware(['auth:admin'])->name('admin.')->prefix('admin')->group(function() {
    // Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
    // Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    // Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['throttle:6,1'])->name('verification.send');

    // Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    // Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change-password.form');
    Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('change-password.update');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // admin dashboard route
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show', 'destroy']);
    Route::resource('notebooks', NotebookController::class)->except(['create', 'edit', 'show', 'destroy']);

});