<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ProdukController::class)->group(function () {
    Route::get('/produk', 'index')->name("produk-index");
    Route::post('/produk', 'store')->name("produk-store");
    Route::delete('/produk/{product:nama}', 'destroy')->name("produk-delete");
});

Route::controller(ChannelController::class)->group(function () {
    Route::get('/channel', 'index')->name("channel-index");
    Route::post('/channel', 'store')->name("channel-store");
    Route::delete('/channel/{channel:nama}', 'destroy')->name("channel-delete");
});

Route::controller(BrandController::class)->group(function () {
    Route::get('/brand', 'index')->name("brand-index");
    Route::post('/brand', 'store')->name("brand-store");
    Route::delete('/brand/{brand:nama}', 'destroy')->name("brand-delete");
});

Route::controller(TransaksiController::class)->group(function () {
    Route::get('/transaksi', 'index')->name("transaksi-index");
    Route::post('/transaksi', 'store')->name("transaksi-store");
    Route::delete('/transaksi/{transaksi:nama}', 'destroy')->name("transaksi-delete");
});
Route::get('/dashboard', [DashboardController::class, "index"])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/export/', [DashboardController::class, 'export'])->name("export");

require __DIR__ . '/auth.php';
