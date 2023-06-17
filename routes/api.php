<?php

use App\Http\Controllers\{
    GuruController,
    KelasController,
    PertemuanController,
    PetaKerawananController,
    UserController,
    WaliKelasController,
};
use App\Http\Controllers\Api\{
    AuthApiController,
    PertemuanApiController,
    UserApiController
};
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::resource('user', UserController::class);
// Route::resource('guru', GuruController::class);
// Route::resource('walas', WaliKelasController::class);
// Route::resource('petakerawanan', PetaKerawananController::class);
// Route::resource('userapi', UserApiController::class);
Route::apiResource('pertemuanapi', PertemuanApiController::class);
Route::post('/login', [AuthApiController::class, 'postLogin']);