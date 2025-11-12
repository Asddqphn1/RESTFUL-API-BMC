<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidanController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\JwtCookieMiddleware;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware([JwtCookieMiddleware::class])->group(function () {
    // Bidan
    Route::post('/bidan/register-pasien', [BidanController::class, 'registerPasien']);
    
    // Profil
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::put('/profile/password', [ProfileController::class, 'updatePassword']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
