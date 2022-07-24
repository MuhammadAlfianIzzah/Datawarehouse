<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportDataController;
use App\Http\Controllers\HomeController;
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
    // return view("welcome");
    return redirect()->route("dashboard");
});
Route::middleware(["auth"])->group(function () {
    Route::controller(ProdukController::class)->group(function () {
        Route::get('/produk', 'index')->name("produk-index");
        Route::get('/produk/{product:id}', 'show')->name("produk-show");
        Route::get('/produk/{product:id}/edit', 'edit')->name("produk-edit");

        Route::post('/produk', 'store')->name("produk-store");
        Route::put('/produk/{product:id}', 'update')->name("produk-update");
        Route::delete('/produk/{product:id}', 'destroy')->name("produk-delete");
        Route::post("/produk/import", "import")->name("produk-import");
    });

    Route::controller(ChannelController::class)->group(function () {
        Route::get('/channel', 'index')->name("channel-index");
        Route::post('/channel', 'store')->name("channel-store");
        Route::delete('/channel/{channel:id}', 'destroy')->name("channel-delete");
        Route::get('/channel/{channel:id}/edit', 'edit')->name("channel-edit");
        Route::put('/channel/{channel:id}', 'update')->name("channel-update");
        Route::post("/channel/import", "import")->name("channel-import");
    });

    Route::controller(BrandController::class)->group(function () {
        Route::get('/brand', 'index')->name("brand-index");
        Route::post('/brand', 'store')->name("brand-store");
        Route::delete('/brand/{brand:id}', 'destroy')->name("brand-delete");
        Route::get('/brand/{brand:id}/edit', 'edit')->name("brand-edit");
        Route::put('/brand/{brand:id}', 'update')->name("brand-update");
        Route::post("/brand/import", "import")->name("brand-import");
    });

    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/transaksi', 'index')->name("transaksi-index");
        Route::get('/transaksi/{factSales:id}', 'show')->name("transaksi-show");
        Route::post('/transaksi', 'store')->name("transaksi-store");
        Route::delete('/transaksi/{transaksi:id}', 'destroy')->name("transaksi-delete");
        Route::post("/transaksi/import", "import")->name("transaksi-import");
        Route::get("/generate-data", "refresh")->name("generate-data");
    });
    Route::get("/export-data", [ExportDataController::class, 'index'])->name("export-index");
    Route::get("/export-data/pertahun", [ExportDataController::class, 'byyear'])->name("export-pertahun");
    Route::get("/export-data/bybrand", [ExportDataController::class, 'bybrand'])->name("export-bybrand");
    Route::get("/export-data/pertahun/cetak", [ExportDataController::class, 'byyearCetak'])->name("export-pertahun-cetak");
    Route::get("/export-data/bybrand/cetak", [ExportDataController::class, 'bybrandExport'])->name("export-bybrand-cetak");
    Route::controller(HomeController::class)->group(function () {
        Route::get('/database', 'export')->name("db-export");
    });







    Route::get('/dashboard/export/', [DashboardController::class, 'export'])->name("export");
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
});


require __DIR__ . '/auth.php';
