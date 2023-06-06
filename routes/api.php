<?php

use App\Http\Controllers\{
    GuruController,
    PetaKerawananController,
    UserController,
    WaliKelasController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('user', UserController::class);
Route::resource('guru', GuruController::class);
Route::resource('walas', WaliKelasController::class);
Route::resource('petakerawanan', PetaKerawananController::class);