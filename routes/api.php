<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndentificationController;

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

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('users', UserController::class)->only(['index', 'show', 'update', 'destroy']);

    Route::apiResource('events', EventController::class);

    Route::prefix('events')->group(function () {

        Route::post('/{id}/compare-faces', [EventController::class, 'compareFaces']);

        Route::apiResource('/{event}/identifications', IndentificationController::class);
        Route::apiResource('/{event}/images', ImageController::class);
    });
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

    Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->middleware('auth:sanctum');
});
