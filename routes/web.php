<?php
use App\Http\Controllers\{PelangganController, StafController, ObatController};
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/pelanggan');
Route::resource('pelanggan', PelangganController::class)->only(['index', 'store', 'destroy']);
Route::resource('staf', StafController::class)->only(['index', 'store', 'destroy']);
Route::resource('obat', ObatController::class)->only(['index', 'store', 'destroy']);
