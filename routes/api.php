<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\JenisTagihanController;
use App\Http\Controllers\TagihanSiswaController;
use App\Http\Controllers\PaymentDetailController;
use App\Http\Controllers\TransaksiDetailController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// GET all & POST siswa
Route::get('/siswa', [SiswaController::class, 'index']);
Route::post('/siswa', [SiswaController::class, 'store']);

// GET, PUT, DELETE by ID dengan route berbeda
Route::get('/siswa-id/{id}', [SiswaController::class, 'show']);
Route::put('/siswa-id/{id}', [SiswaController::class, 'update']);
Route::delete('/siswa-id/{id}', [SiswaController::class, 'destroy']);
Route::get('/siswa-nis/{nis}', [SiswaController::class, 'getByNis']);

Route::get('/payments', [PaymentController::class, 'index']);
Route::post('/payments', [PaymentController::class, 'store']);
Route::get('/payments/{id}', [PaymentController::class, 'show']);
Route::delete('/payments/{id}', [PaymentController::class,'destroy']);

Route::get('/transaksi', [TransaksiController::class, 'index']); // Menampilkan semua transaksi
Route::post('/transaksi', [TransaksiController::class, 'store']); // Membuat transaksi baru
Route::get('/transaksi/{id}', [TransaksiController::class, 'show']); // Menampilkan transaksi berdasarkan ID
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']); // Menghapus transaksi
Route::post('/midtrans/callback', [TransaksiController::class, 'handleCallback']);
Route::get('/riwayat-pembayaran/{nis}', [TransaksiController::class, 'riwayatByNIS']);

// GET all & POST jenis tagihan
Route::get('/jenis-tagihan', [JenisTagihanController::class, 'index']);
Route::post('/jenis-tagihan', [JenisTagihanController::class, 'store']);
// GET, PUT, DELETE by ID dengan route berbeda
Route::get('/jenis-tagihan-id/{id}', [JenisTagihanController::class, 'show']);
Route::put('/jenis-tagihan-id/{id}', [JenisTagihanController::class, 'update']);
Route::delete('/jenis-tagihan-id/{id}', [JenisTagihanController::class, 'destroy']);

// GET all & POST tagihan siswa
Route::get('/tagihan-siswa', [TagihanSiswaController::class, 'index']);
Route::post('/tagihan-siswa', [TagihanSiswaController::class, 'store']);
// GET, PUT, DELETE by ID dengan route berbeda
Route::get('/tagihan-siswa-id/{id}', [TagihanSiswaController::class, 'show']);
Route::put('/tagihan-siswa-id/{id}', [TagihanSiswaController::class, 'update']);
Route::delete('/tagihan-siswa-id/{id}', [TagihanSiswaController::class, 'destroy']);
Route::get('/tagihan-siswa-nis', [TagihanSiswaController::class, 'getTagihanByNis']);

Route::post('/bayar', [TagihanSiswaController::class, 'bayarBeberapaTagihan']);

Route::post('/payment-detail', [PaymentDetailController::class, 'store']);

Route::post('/transaksi-detail', [TransaksiDetailController::class, 'store']);
