<?php

use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\GuessController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/auth')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/challenge')->group(function () {
        Route::post('/new', [ChallengeController::class, 'store']);
    });

    Route::prefix('/guess')->group(function () {
        Route::post('/submit', [GuessController::class, 'store']);
    });
    // Add more routes as needed
});

Route::prefix('/challenge')->group(function () {
    Route::post('/all', [ChallengeController::class, 'index']);
    Route::get('/{id}', [ChallengeController::class, 'show']);

});

// Route::middleware(['web', 'auth'])->group(function () {
//     // Your routes here...
//     Route::prefix('/challenge')->group(function () {
//         Route::post('/new', [ChallengeController::class, 'store']);
//     });
// });