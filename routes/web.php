<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('/barang', BarangController::class);
Route::resource('/barangmasuk', BarangMasukController ::class);
Route::resource('/barangkeluar', BarangKeluarController::class);
Route::get('/tambahbarang', [BarangController::class, 'create'])->name('barang.create');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
