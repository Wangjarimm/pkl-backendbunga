<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransaksiController;




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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// GET all & POST siswa
Route::get('/siswa', [SiswaController::class, 'index']);
Route::post('/siswa', [SiswaController::class, 'store']);

// GET, PUT, DELETE by ID dengan route berbeda
Route::get('/siswa-id/{id}', [SiswaController::class, 'show']);
Route::put('/siswa-id/{id}', [SiswaController::class, 'update']);
Route::delete('/siswa-id/{id}', [SiswaController::class, 'destroy']);

Route::get('/payments', [PaymentController::class, 'index']);
Route::post('/payments', [PaymentController::class, 'store']);
Route::get('/payments/{id}', [PaymentController::class, 'show']);
Route::delete('/payments/{id}', [PaymentController::class,'destroy']);

Route::get('/transaksi', [TransaksiController::class, 'index']); // Menampilkan semua transaksi
Route::post('/transaksi', [TransaksiController::class, 'store']); // Membuat transaksi baru
Route::get('/transaksi/{id}', [TransaksiController::class, 'show']); // Menampilkan transaksi berdasarkan ID
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']); // Menghapus transaksi
