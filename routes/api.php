<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PelangganController, StafController, ObatController};

Route::apiResource('pelanggan', PelangganController::class)->names('api.pelanggan');
Route::apiResource('staf', StafController::class)->names('api.staf');
Route::apiResource('obat', ObatController::class)->names('api.obat');
