<?php

use App\Http\Controllers\Dashboard\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\Auth\NewPasswordController;
use App\Http\Controllers\Dashboard\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::group([], function () {
    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::group(['as' => 'password.'], function () {
            Route::get('forgot-password', [PasswordResetController::class, 'create'])->name('request');
            Route::post('forgot-password', [PasswordResetController::class, 'store'])->name('email');
            Route::get('verify-code/{token}', [PasswordResetController::class, 'code'])->name('code');
            Route::post('verify-code', [PasswordResetController::class, 'verifyCode'])->name('verify-code');
            Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('reset');
            Route::post('reset-password', [NewPasswordController::class, 'store'])->name('update');
        });
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});


