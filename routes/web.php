<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\TanggapanController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\User\PasswordController;
use App\Http\Controllers\User\SocialController;
use App\Http\Controllers\User\UserController;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('call.index');
Route::post('/store', [UserController::class, 'storePengaduan'])->name('call.store');


Route::get('/pengaduan', [UserController::class, 'pengaduan'])->name('call.pengaduan');
Route::get('tentang', [UserController::class, 'tentang'])->name('call.tentang');



Route::middleware(['isSiswa'])->group(function () {
    // Ganti Email & Telp
    Route::post('/siswa/ubah/{ubah}', [UserController::class, 'ubah'])->name('call.ubah');

    // Pengaduan
    Route::get('/laporan/{siapa?}', [UserController::class, 'laporan'])->name('call.laporan');
    Route::get('/detail-laporan/{id_pengaduan}', [UserController::class, 'laporanDetail'])->name('call.detail');
    Route::get('/edit-laporan/{id_pengaduan}', [UserController::class, 'laporanEdit'])->name('call.edit');
    Route::patch('/update-laporan/{id_pengaduan}', [UserController::class, 'laporanUpdate'])->name('call.laporanUpdate');
    Route::delete('/hapus-laporan', [UserController::class, 'laporanDestroy'])->name('call.laporanDestroy');

    // Profil
    Route::get('/siswa/profil', [UserController::class, 'profil'])->name('call.profil');
    Route::post('/siswa/profil', [UserController::class, 'updateProfil'])->name('call.updateProfil');

    // Ganti Password
    Route::get('/password', [UserController::class, 'password'])->name('call.password');
    Route::post('/password/update', [UserController::class, 'updatePassword'])->name('call.updatePassword');

    // Logout Siswa
    Route::get('/logout', [UserController::class, 'logout'])->name('call.logout');
});

Route::middleware(['guest'])->group(function () {
    // Login Siswa
    Route::get('/masuk', [UserController::class, 'masuk'])->name('call.masuk');
    Route::post('/login/auth', [UserController::class, 'login'])->name('call.login');

    // Register
    Route::get('/daftar', [UserController::class, 'daftar'])->name('call.daftar');
    Route::post('/register/auth', [UserController::class, 'register'])->name('call.register');

});

Route::prefix('admin')->group(function () {

    Route::middleware(['isAdmin'])->group(function () {
        // Petugas
        
        Route::resource('petugas', PetugasController::class);

        // Siswa
        Route::resource('siswa', SiswaController::class);

        // Laporan
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::post('getLaporan', [LaporanController::class, 'getLaporan'])->name('laporan.getLaporan');
        Route::post('laporan/cetak', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetakLaporan');
        Route::get('allLaporan', [LaporanController::class, 'all'])->name('laporan.all');
    });

    Route::middleware(['isPetugas'])->group(function () {
        // Dashboarda
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Pengaduan
        Route::get('pengaduan/{status}', [PengaduanController::class, 'filterPengaduan'])->name('call.filterPengaduan');
        Route::get('pengaduan/show/{id_pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::delete('pengaduan/destroy/{id_pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

        // Taanggapan
        Route::post('tanggapan/createOrUpdate', [TanggapanController::class, 'createOrUpdate'])->name('tanggapan.createOrUpdate');

        // Logout
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });

    Route::middleware(['isGuest'])->group(function () {
        Route::get('/', [AdminController::class, 'formLogin'])->name('admin.formLogin');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    });

    Route::get('grafik', [GrafikController::class, 'grafik']);

 
});
