<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;

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

    Route::apiResources([
        'users' => App\Http\Controllers\UserController::class,
        'events' => App\Http\Controllers\EventController::class,
    ]);

    Route::prefix('events')->group(function () {
        Route::get('/{event_id}/images', [App\Http\Controllers\EventImageController::class, 'index']);
        Route::post('/{event_id}/images', [App\Http\Controllers\EventImageController::class, 'store']);
        Route::delete('/{event_id}/images/{id}', [App\Http\Controllers\EventImageController::class, 'destroy']);


        Route::get('/{event_id}/identifications', [App\Http\Controllers\EventIndentificationController::class, 'index']);
        Route::post('/{event_id}/identifications', [App\Http\Controllers\EventIndentificationController::class, 'store']);
        Route::delete('/{event_id}/identifications/{id}', [App\Http\Controllers\EventIndentificationController::class, 'destroy']);
    });
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

    Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->middleware('auth:sanctum');
});
