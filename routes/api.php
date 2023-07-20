<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IdentificationController;

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

    Route::apiResource('events/{event_id}/identifications', IdentificationController::class);

    Route::apiResource('events/{event_id}/images', ImageController::class);





    Route::prefix('events')->group(function () {
        Route::get('/{event_id}/images', [App\Http\Controllers\ImageController::class, 'index']);
        Route::post('/{event_id}/images', [App\Http\Controllers\ImageController::class, 'store']);
        Route::delete('/{event_id}/images/{id}', [App\Http\Controllers\ImageController::class, 'destroy']);


        Route::get('/{event_id}/identifications', [App\Http\Controllers\IdentificationController::class, 'index']);
        Route::post('/{event_id}/identifications', [App\Http\Controllers\IdentificationController::class, 'store']);
        Route::delete('/{event_id}/identifications/{id}', [App\Http\Controllers\IdentificationController::class, 'destroy']);
    });
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

    Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->middleware('auth:sanctum');
});
