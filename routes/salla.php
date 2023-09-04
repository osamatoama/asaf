<?php

use App\Http\Controllers\Salla\CallbackController;
use App\Http\Controllers\Salla\RedirectAwayController;
use Illuminate\Support\Facades\Route;

Route::prefix('salla')->as('salla.')->group(function () {
    Route::get('oauth/redirect', RedirectAwayController::class)->name('redirect');
    Route::get('oauth/callback', CallbackController::class)->name('callback');
});
