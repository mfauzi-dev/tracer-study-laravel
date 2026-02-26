<?php

use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\PertanyaanController;
use App\Http\Controllers\Admin\PilihanJawabanController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\TahunAkademikController;
use App\Http\Controllers\Alumni\BiodataController;
use App\Http\Controllers\Alumni\DashboardController as AlumniDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Login
Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login/store', [LoginController::class, 'store'])->name('login.store');

Route::middleware('auth')->group(function() {
    Route::post('logout', [LogoutController::class, 'index'])->name('logout');

});

Route::prefix('alumni')->middleware(['auth', 'role:alumni'])->group(function() {
    Route::get('/', [AlumniDashboardController::class, 'index'])->name('alumni.dashboard');

    Route::prefix('biodata')->group(function() {
        Route::get('/', [BiodataController::class, 'index'])->name('alumni.biodata');
        Route::get('/create', [BiodataController::class, 'create'])->name('alumni.biodata.create');
        Route::post('/store', [BiodataController::class, 'store'])->name('alumni.biodata.store');
        Route::get('/me', [BiodataController::class, 'show'])->name('alumni.biodata.show');
        Route::get('/edit', [BiodataController::class, 'edit'])->name('alumni.biodata.edit');
        Route::put('/update', [BiodataController::class, 'update'])->name('alumni.biodata.update');
    });
});


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('user/alumni')->group(function() {
        Route::get('/', [AlumniController::class, 'index'])->name('admin.alumni');
        Route::get('/create', [AlumniController::class, 'create'])->name('admin.alumni.create');
        Route::post('/store', [AlumniController::class, 'store'])->name('admin.alumni.store');
        Route::delete('{id}/delete', [AlumniController::class, 'destroy'])->name('admin.alumni.delete');
    });

    Route::prefix('pertanyaan')->group(function() {
        Route::get('/', [PertanyaanController::class, 'index'])->name('admin.pertanyaan');
        Route::get('/create', [PertanyaanController::class, 'create'])->name('admin.pertanyaan.create');
        Route::post('/store', [PertanyaanController::class, 'store'])->name('admin.pertanyaan.store');
        Route::delete('{id}/delete', [PertanyaanController::class, 'destroy'])->name('admin.pertanyaan.delete');
        Route::get('/status', [PertanyaanController::class, 'getStatus'])->name('admin.pertanyaan.status');
        Route::put('/status/store', [PertanyaanController::class, 'storeStatus'])->name('admin.pertanyaan.status.store');
        Route::get('/copy', [PertanyaanController::class, 'getCopy'])->name('admin.pertanyaan.copy');
        Route::post('/copy/store', [PertanyaanController::class, 'storeCopy'])->name('admin.pertanyaan.copy.store');
        
    });

    Route::prefix('pilihan-jawaban')->group(function() {
        Route::get('/', [PilihanJawabanController::class, 'index'])->name('admin.pilihan');
        Route::get('/create', [PilihanJawabanController::class, 'create'])->name('admin.pilihan.create');
        Route::post('/store', [PilihanJawabanController::class, 'store'])->name('admin.pilihan.store');
    });

    Route::prefix('tahun-akademik')->group(function() {
        Route::get("/", [TahunAkademikController::class, 'index'])->name('admin.tahun_akademik');
        Route::get("/create", [TahunAkademikController::class, 'create'])->name('admin.tahun_akademik.create');
        Route::post("/store", [TahunAkademikController::class, 'store'])->name('admin.tahun_akademik.store');
        Route::get('{id}/edit', [TahunAkademikController::class, 'edit'])->name('admin.tahun_akademik.edit');
        Route::put('{id}/update', [TahunAkademikController::class, 'update'])->name('admin.tahun_akademik.update');
        Route::delete('{id}/delete', [TahunAkademikController::class, 'destroy'])->name('admin.tahun_akademik.delete');
    });

    Route::prefix('fakultas')->group(function() {
        Route::get("/", [FakultasController::class, 'index'])->name('admin.fakultas');
        Route::get("/create", [FakultasController::class, 'create'])->name('admin.fakultas.create');
        Route::post("/store", [FakultasController::class, 'store'])->name('admin.fakultas.store');
        Route::get('{id}/edit', [FakultasController::class, 'edit'])->name('admin.fakultas.edit');
        Route::put('{id}/update', [FakultasController::class, 'update'])->name('admin.fakultas.update');
        Route::delete('{id}/delete', [FakultasController::class, 'destroy'])->name('admin.fakultas.delete');
    });

    Route::prefix('program-studi')->group(function () {
        Route::get("/", [ProgramStudiController::class, 'index'])->name('admin.program-studi');
        Route::get("/create", [ProgramStudiController::class, 'create'])->name('admin.program-studi.create');
        Route::post("/store", [ProgramStudiController::class, 'store'])->name('admin.program-studi.store');
        Route::get('{id}/edit', [ProgramStudiController::class, 'edit'])->name('admin.program-studi.edit');
        Route::put('{id}/update', [ProgramStudiController::class, 'update'])->name('admin.program-studi.update');
        Route::delete('{id}/delete', [ProgramStudiController::class, 'destroy'])->name('admin.program-studi.delete');
    });
});
