<?php

use App\Http\Controllers\{
    AktivitasController,
    ArsipController,
    DashboardController,
    KelasController,
    PertemuanController,
    UserController
};
use App\Http\Controllers\Auth\AuthController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::prefix('auth')->name('auth.')->group(function(){
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('post.login');
});

Route::resource('kelas',KelasController::class);
Route::resource('user',UserController::class);
Route::resource('aktivitas',AktivitasController::class);
Route::resource('arsip',ArsipController::class);
Route::resource('pertemuan',PertemuanController::class);

Route::get('/generatepdf', function(){
    $pdf = Pdf::loadView('pdf.index');
    return $pdf->stream('download.pdf');
});