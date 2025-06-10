<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);//yes
Route::post('/forgot-password', [AuthController::class, 'forgot']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/user/profile-image', [UserController::class, 'uploadProfileImage']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/reset-password', [AuthController::class, 'reset']);
});