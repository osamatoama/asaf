<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\QuizController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\GenderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\AuditLogController;
use App\Http\Controllers\Dashboard\DropzoneController;
use App\Http\Controllers\Dashboard\QuizQuestionController;
use App\Http\Controllers\Dashboard\QuizQuestionAnswerController;

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

    //Genders
    Route::group(['prefix' => 'genders', 'as' => 'genders.'], function () {
        Route::get('', [GenderController::class, 'index'])->name('index');
        Route::get('{gender}', [GenderController::class, 'show'])->name('show');
    });

    //Products
    Route::resource('products', ProductController::class);

    //Quizzes
    Route::resource('quizzes', QuizController::class)
        ->except(['create', 'store', 'destroy']);

    Route::resource('quiz-questions', QuizQuestionController::class)
        ->only(['store', 'update', 'destroy']);

    Route::resource('quiz-question-answers', QuizQuestionAnswerController::class)
        ->only(['store', 'update', 'destroy']);

    //Clients
    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
        Route::get('', [ClientController::class, 'index'])->name('index');
        Route::get('{client}', [ClientController::class, 'show'])->name('show');
    });

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
