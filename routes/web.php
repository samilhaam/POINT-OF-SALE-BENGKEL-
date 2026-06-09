<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;

//Route::get('/', function () {
    //return view('welcome');
//});
//
Route::get('/', [TransaksiController::class, 'dashboard'])->name('dashboard');

Route::resource('barang', BarangController::class);

Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

// TAMBAHKAN BARIS INI UNTUK FITUR CETAK:
Route::get('laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');

// TAMBAHKAN RUTE HAPUS TRANSAKSI INI:
Route::delete('transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');