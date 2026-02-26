<?php

use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
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

// Route::post('/login', [LoginController::class, 'login']);

// Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function() {
//     Route::apiResource('fakultas', FakultasController::class);

//     Route::apiResource('program-studi', ProgramStudiController::class);

//     Route::apiResource('user', UserController::class);
// });

// Route::prefix('alumni')->middleware(['auth:sanctum', 'role:alumni'])->group(function() {
//     Route::apiResource('fakultas', FakultasController::class);

//     Route::apiResource('program-studi', ProgramStudiController::class);

//     Route::apiResource('user', UserController::class);
// });
