<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/barang', BarangController::class);
Route::resource('/barangmasuk', BarangMasukController ::class);
Route::resource('/barangkeluar', BarangKeluarController::class);
Route::get('/tambahbarang', [BarangController::class, 'create'])->name('barang.create');
