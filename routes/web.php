<?php
use App\Http\Controllers\{PelangganController, StafController, ObatController};
use App\Models\{Pelanggan, Staf, Obat};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // rescue(): halaman welcome tetap tampil walau database belum dimigrasi
    return view('welcome', [
        'jmlPelanggan' => rescue(fn () => Pelanggan::count(), 0, false),
        'jmlStaf'      => rescue(fn () => Staf::count(), 0, false),
        'jmlObat'      => rescue(fn () => Obat::count(), 0, false),
    ]);
})->name('beranda');

Route::resource('pelanggan', PelangganController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('staf', StafController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('obat', ObatController::class)->only(['index', 'store', 'destroy']);
