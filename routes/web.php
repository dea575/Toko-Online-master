<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//Order
Route::get('/order/{id}', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
Route::post('/pesan/{id}', [App\Http\Controllers\OrderController::class, 'keranjang'])->name('order');
Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
Route::delete('/checkout/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('checkout');
Route::get('/konfirmasi_checkout', [App\Http\Controllers\OrderController::class, 'konfirmasi_checkout'])->name('checkout');
Route::get('/bayar', [App\Http\Controllers\OrderController::class, 'bayar'])->name('bayar');

//hak akses adnmin
Route::group(['middleware' => 'admin'], function () {
    //BARANG
    Route::get('/barang', [App\Http\Controllers\BarangController::class, 'index'])->name('barang');
    Route::get('/tambah', [App\Http\Controllers\BarangController::class, 'add'])->name('tambah');
    Route::post('/tambah', [App\Http\Controllers\BarangController::class, 'addprocess'])->name('tambah');
    Route::get('/edit/{id}', [App\Http\Controllers\BarangController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [App\Http\Controllers\BarangController::class, 'editprocess'])->name('edit');
    Route::delete('/hapus/{id}', [App\Http\Controllers\BarangController::class, 'destroy'])->name('hapus');
});


