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
        'users' => UserController::class,
        'events' => EventController::class,
    ]);

});

Route::prefix('auth')->group(function() {
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::post('/register', [RegisterController::class, 'register']);
    
    Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');
});
