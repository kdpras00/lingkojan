<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\RT;
use App\Http\Controllers\RW;
use App\Http\Controllers\Warga;
use App\Http\Controllers\Petugas;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $latestPengaduans = \App\Models\PengaduanHeader::whereHas('details', function($q) {
        $q->whereIn('id', function($sub) {
            $sub->select(Illuminate\Support\Facades\DB::raw('min(id)'))
                ->from('pengaduan_detail')
                ->groupBy('pengaduan_header_id');
        })->whereHas('user', function($u) {
            $u->where('role_id', 1); // 1 = Warga
        });
    })
    ->with(['details.user', 'details.status', 'details.fotos'])
    ->orderBy('id', 'desc')
    ->take(10)
    ->get();
    return view('welcome', compact('latestPengaduans'));
})->name('home');
Route::view('/tentang', 'tentang')->name('tentang');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Grouped by Role)
|--------------------------------------------------------------------------
*/

// Warga Routes
Route::middleware(['auth'])->prefix('warga')->as('warga.')->group(function () {
    Route::get('/dashboard', [Warga\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pengaduan', Warga\PengaduanController::class)->only(['index', 'create', 'show', 'store']);
    Route::post('pengaduan/{id}/cancel', [Warga\PengaduanController::class, 'cancel'])->name('pengaduan.cancel');
});

// RT Routes
Route::middleware(['auth'])->prefix('rt')->as('rt.')->group(function () {
    Route::get('/dashboard', [RT\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('warga', RT\WargaController::class)->only(['index', 'show']);
    
    Route::controller(RT\PengaduanController::class)->prefix('pengaduan')->as('pengaduan.')->group(function () {
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/print', 'print')->name('print');
    });
});

// RW Routes
Route::middleware(['auth'])->prefix('rw')->as('rw.')->group(function () {
    Route::get('/dashboard', [RW\DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/warga', [RW\WargaController::class, 'index'])->name('warga.index');
    Route::get('/warga/{id}', [RW\WargaController::class, 'show'])->name('warga.show');
    Route::get('/petugas', [RW\PetugasController::class, 'index'])->name('petugas.index');
    Route::get('/petugas/{id}', [RW\PetugasController::class, 'show'])->name('petugas.show');

    Route::controller(RW\PengaduanController::class)->prefix('pengaduan')->as('pengaduan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/recap', 'recap')->name('recap');
        Route::get('/recap/detail', 'recapDetail')->name('recap.detail');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/print', 'print')->name('print');
    });
});

// Petugas Routes
Route::middleware(['auth'])->prefix('petugas')->as('petugas.')->group(function () {
    Route::get('/dashboard', [Petugas\DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
        Route::get('/', [Petugas\PengaduanController::class, 'index'])->name('index');
        Route::get('/{id}', [Petugas\PengaduanController::class, 'show'])->name('show');
        Route::post('/{id}/tindak-lanjut', [Petugas\PengaduanController::class, 'storeTindakLanjut'])->name('storeTindakLanjut');
    });
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {
    
    // Core Dashboard & Menu
    Route::controller(Admin\DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/menu', 'menu')->name('menu');
        Route::get('/pencarian', 'search')->name('pencarian');
    });

    // Resource Management
    Route::resource('users', Admin\UserController::class);
    Route::resource('rt', Admin\RTController::class)->except(['show']);
    Route::resource('ketua_rt', Admin\KetuaRTController::class)->except(['show']);
    
    // Warga Management with Custom Password Reset and Approval
    Route::resource('warga', Admin\WargaController::class);
    Route::post('/warga/{id}/approve', [Admin\WargaController::class, 'approve'])->name('warga.approve');
    Route::post('/warga/{id}/reject', [Admin\WargaController::class, 'reject'])->name('warga.reject');
    Route::get('/warga/{id}/reset-password', [Admin\WargaController::class, 'resetPassword'])->name('warga.reset_password');
    Route::put('/warga/{id}/reset-password', [Admin\WargaController::class, 'updatePassword'])->name('warga.update_password');

    // Petugas Management with Custom Password Reset
    Route::resource('petugas', Admin\PetugasController::class);
    Route::get('/petugas/{id}/reset-password', [Admin\PetugasController::class, 'resetPassword'])->name('petugas.reset_password');
    Route::put('/petugas/{id}/reset-password', [Admin\PetugasController::class, 'updatePassword'])->name('petugas.update_password');

    // Complaints & Reports
    Route::resource('pengaduan', Admin\PengaduanController::class)->only(['index', 'show']);
    Route::get('/pengaduan/{id}/print', [Admin\PengaduanController::class, 'print'])->name('pengaduan.print');
    Route::get('/laporan/export', [Admin\LaporanController::class, 'exportCsv'])->name('laporan.export');
    Route::get('/laporan', [Admin\LaporanController::class, 'index'])->name('laporan.index');
});
