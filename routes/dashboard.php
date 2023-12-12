<?php

use App\Http\Controllers\Dashboard\DropzoneController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Requests\Dashboard\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->as('dashboard.')->group(function () {
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
    });

    //Products
    Route::resource('products', ProductController::class);
});
