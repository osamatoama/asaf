<?php

use App\Http\Controllers\Website\QuizController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'website.'], function () {
    // Quiz
    Route::get('perfume-quiz', QuizController::class)->name('perfume-quiz');
});
