<?php

use App\Http\Controllers\{
    AktivitasController,
    ArsipController,
    DashboardController,
    KelasController,
    PertemuanController,
    PetaKerawananController,
    UserController,
    UserPetaKerawananController
};
use App\Http\Controllers\Auth\AuthController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('landing_page');
})->name('landingpage');

Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard', 'index')->name('dashboard')->middleware('auth');
});

Route::name('auth.')->group(function(){
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'postLogin'])->name('post.login');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('post.logout');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware('hasLoginAdmin')->group(function () {
        Route::resource('kelas',KelasController::class);
        Route::resource('user',UserController::class);
        Route::resource('aktivitas',AktivitasController::class);
        Route::resource('arsip',ArsipController::class);
        Route::resource('petakerawanan',PetaKerawananController::class);
        Route::prefix('petakerawanan')->name('petakerawanan.')->group(function(){
            Route::post('/import', [PetaKerawananController::class, 'import'])->name('import');
        });
    });

    Route::resource('pertemuan',PertemuanController::class);
    Route::resource('profile', UserPetaKerawananController::class);

    Route::get('/generatepdf', function(){
        $pdf = Pdf::loadView('pdf.index');
        return $pdf->stream('download.pdf');
    });
});