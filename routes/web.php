<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersiswaController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
});

Route::get('/login/admin', [AuthController::class, 'ShowLogin'])->name('show.admin.login');
Route::post('/login/admin', [AuthController::class, 'loginAdmin'])->name('login.admin');
Route::get('/login/siswa', [AuthController::class, 'ShowLoginSiswa'])->name('show.siswa.login');
Route::post('/login/siswa', [AuthController::class, 'loginSiswa'])->name('login.siswa');

// Admin only
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/users/admin', [UserController::class, 'storeAdmin'])->name('users.storeAdmin');
    Route::post('/users/siswa', [UserController::class, 'storeSiswa'])->name('users.storeSiswa');
    Route::resource('users', UserController::class);
    Route::resource('bukus', BookController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::patch('transaksi/{transaksi}/kembalikan', [TransaksiController::class, 'kembalikan'])
         ->name('transaksi.kembalikan');
});

Route::middleware(['siswa'])->prefix('siswa')->name('PageSiswa.')->group(function () {
    Route::get('/home',              [UsersiswaController::class, 'index'])->name('home');
    Route::get('/buku',              [UsersiswaController::class, 'buku'])->name('buku');
    Route::get('/buku/{id}',         [UsersiswaController::class, 'detail'])->name('detail');
    Route::get('/transaksi',         [UsersiswaController::class, 'transaksi'])->name('transaksi');
    Route::post('/buku/{id}/pinjam', [UsersiswaController::class, 'pinjam'])->name('pinjam'); // ← tambah
    Route::patch('/tranasksi/{id}/kembalikan', [UsersiswaController::class, 'kembalikan'])->name('kembalikan'); // ← tambah
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
