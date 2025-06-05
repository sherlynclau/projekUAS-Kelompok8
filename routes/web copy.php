<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profil', function () { //utk di web
    return view ('profil'); //samain kek view
});

Route::resource('/barang', BarangController::class);
Route::resource('/barangmasuk', BarangMasukController ::class);
Route::resource('/barangkeluar', BarangKeluarController::class);
Route::resource('/dashboard', DashboardController::class);
Route::get('/tambahbarang', [BarangController::class, 'create'])->name('barang.create');

