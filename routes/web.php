<?php

use App\Http\Controllers\{
    AktivitasController,
    ArsipController,
    DashboardController,
    KelasController,
    PertemuanController,
    PetaKerawananController,
    ProfileController,
    UserController,
    UserPetaKerawananController
};
use App\Http\Controllers\Auth\AuthController;
use App\Models\Guru;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    $datas = Guru::with('user')->get();
    return view('landing_page', compact('datas'));
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
    Route::resource('kelas',KelasController::class);
    // route user
    Route::resource('user',UserController::class);
    Route::prefix('user/kelas')->name('userkelas.')->group(function(){
        Route::get('/get', [KelasController::class, 'showKelas'])->name('get');
        Route::get('/show/{id}', [KelasController::class, 'showKelasGuru'])->name('show');
        Route::delete('/destroy/{iduser}/{idkelas}', [KelasController::class, 'destroyKelasguru'])->name('destroy');
    });

    Route::resource('aktivitas',AktivitasController::class);
    Route::resource('petakerawanan',PetaKerawananController::class);
    Route::prefix('petakerawanan')->name('petakerawanan.')->group(function(){
        Route::post('/import', [PetaKerawananController::class, 'import'])->name('import');
    });

    Route::resource('userpetakerawanan', UserPetaKerawananController::class);
    Route::prefix('userpetakerawanan/show')->name('userpetakerawanan.')->group(function(){
        Route::get('/peta/{id}', [UserPetaKerawananController::class, 'showpeta'])->name('peta');
        Route::get('/export/{id}', [UserPetaKerawananController::class, 'export'])->name('export');
    });
    
    Route::resource('arsip',ArsipController::class);
    Route::resource('pertemuan',PertemuanController::class);
    Route::prefix('pertemuan/excel')->name('pertemuan.')->group(function(){
        Route::get('/export', [PertemuanController::class, 'export'])->name('export');
        Route::get('/reject/{id}', [PertemuanController::class, 'reject'])->name('reject');
    });
    // route profile
    Route::resource('profile', ProfileController::class);
    Route::prefix('profile/user/')->name('profile.')->group(function(){
        Route::get('form', [ProfileController::class, 'formProfile'])->name('formedit');
        Route::post('kelas', [ProfileController::class, 'addKElas'])->name('addKelas');
    });

    Route::get('/generatepdf', function(){
        $pdf = Pdf::loadView('pdf.index');
        return $pdf->stream('download.pdf');
    });
});