<?php

use App\Http\Controllers\Api\QuizController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->as('api.')->group(function () {
    Route::get('quiz/info', [QuizController::class, 'info'])->name('quiz.info');
    Route::get('quiz', [QuizController::class, 'index'])->name('quiz');
    Route::post('results', [QuizController::class, 'results'])->name('results');


    Route::get('test-steps-data', function () {
        return json_decode(file_get_contents(public_path('quiz/data/steps.json')), true);
    });

    Route::get('test-products-data', function () {
        return json_decode(file_get_contents(public_path('quiz/data/products.json')), true);
    });
});
