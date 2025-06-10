<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;  // <--- Make sure to import this
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register']);//yes
Route::post('/forgot-password', [AuthController::class, 'forgot']);
Route::post('/reset-password', [AuthController::class, 'reset']);

Route::middleware('auth:sanctum')->post('/user/profile-image', [UserController::class, 'uploadProfileImage']);
Route::middleware('auth:sanctum')->put('/user/profile', [UserController::class, 'updateProfile']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);

Route::put('/debug-cookies', function (Request $request) {
    \Log::info('Debug cookies:', $request->cookies->all());
    return response()->json([
        'cookies' => $request->cookies->all(),
    ]);
});

Route::get('/example', function () {
    return view('example');  // Laravel will look for resources/views/example.blade.php
});