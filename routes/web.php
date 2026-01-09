<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\DosenController;

Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile/edit', [MahasiswaController::class, 'profileEdit'])->name('profile.edit');
        Route::put('/profile/update', [MahasiswaController::class, 'profileUpdate'])->name('profile.update');
        Route::get('/register', [MahasiswaController::class, 'register'])->name('register');
        Route::post('/register', [MahasiswaController::class, 'registerStore'])->name('register.store');
        Route::get('/check-notifications', [MahasiswaController::class, 'checkNotifications'])->name('check.notifications');
        Route::get('/upload', [MahasiswaController::class, 'upload'])->name('upload');
        Route::post('/upload', [MahasiswaController::class, 'uploadStore'])->name('upload.store');
        Route::get('/status', [MahasiswaController::class, 'status'])->name('status');
        Route::get('/bukti/{id}', [MahasiswaController::class, 'bukti'])->name('bukti');
    });
    
    Route::prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');
        Route::get('/detail/{id}', [DosenController::class, 'detailMahasiswa'])->name('detail');
        Route::post('/document/{id}/update', [DosenController::class, 'updateDocumentStatus'])->name('document.update');
        Route::post('/registration/{id}/approve', [DosenController::class, 'approveRegistration'])->name('registration.approve');
    });
    
    Route::prefix('pembimbing')->name('pembimbing.')->group(function () {
        Route::get('/dashboard', [PembimbingController::class, 'dashboard'])->name('dashboard');
        Route::post('/send-message', [PembimbingController::class, 'sendMessage'])->name('send.message');
    });
    
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/mahasiswa', [AdminController::class, 'mahasiswa'])->name('mahasiswa');
        Route::get('/verifikasi', [AdminController::class, 'verifikasi'])->name('verifikasi');
        Route::post('/verifikasi/{id}', [AdminController::class, 'verifikasiUpdate'])->name('verifikasi.update');
        Route::get('/jadwal', [AdminController::class, 'jadwal'])->name('jadwal');
        Route::get('/jadwal/create/{id}', [AdminController::class, 'jadwalCreate'])->name('jadwal.create');
        Route::post('/jadwal/store/{id}', [AdminController::class, 'jadwalStore'])->name('jadwal.store');
        Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
    });
});
