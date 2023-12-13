<?php

use App\Http\Controllers\Dashboard\AuditLogController;
use App\Http\Controllers\Dashboard\DropzoneController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->as('dashboard.')->middleware([
    'authGates',
    'isActive',
    'isVerified',
])->group(function () {
    // Home
    Route::get('', HomeController::class)->name('home');

    //Dropzone
    Route::group(['prefix' => 'dropzone', 'as' => 'dropzone.'], function () {
        Route::post('/', [DropzoneController::class, 'store'])->name('store');
    });

    //Profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::put('change-password', [ProfileController::class, 'changePassword'])->name('change-password');
        Route::put('toggle-dark-mode', [ProfileController::class, 'toggleDarkMode'])->name('toggle-dark-mode');
        Route::get('verification', [ProfileController::class, 'getVerification'])
            ->withoutMiddleware(['isVerified', 'isActive'])
            ->name('get-verification');
        Route::post('verification', [ProfileController::class, 'postVerification'])
            ->withoutMiddleware(['isVerified', 'isActive'])
            ->name('post-verification');
    });

    //Products
    Route::resource('products', ProductController::class);

    //User
    Route::put('users/{user}/toggle/{type}', [UserController::class, 'toggle'])->name('users.toggle');
    Route::resource('users', UserController::class);

    //Role
    Route::resource('roles', RoleController::class);

    //Audit Log
    Route::group(['prefix' => 'audit-logs', 'as' => 'audit-logs.'], function () {
        Route::get('', [AuditLogController::class, 'index'])->name('index');
        Route::get('{audit_log}', [AuditLogController::class, 'show'])->name('show');
    });
});
