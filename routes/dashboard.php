<?php

use App\Http\Controllers\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->as('dashboard.')->group(function () {
    // Home
    Route::get('', HomeController::class)->name('home');
});
