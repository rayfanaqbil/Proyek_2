<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AdminProduksiController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AdminDetailProduksiController;

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

//Index Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Produk
Route::get('/produk', [ProdukController::class, 'produk'])->name('produk');
Route::get('/produk/{produk}', [ProdukController::class, 'detail'])->name('produk-detail');

//Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register_form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

//Login
Route::get('/login', [LoginController::class, 'showFormLogin'])->name('login_form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth:customer');

//Keranjang
Route::middleware('auth:customer')->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
    Route::post('/keranjang/update', [KeranjangController::class, 'update'])->name('keranjang-update');
    Route::delete('/keranjang/delete/{id_keranjang}', [KeranjangController::class, 'delete'])->name('keranjang-delete');
});

//Checkout
Route::get('/checkout/{kode_cs}', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout-process');


//admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin-login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login-admin');
    Route::match(['get', 'post'], '/logout', [AdminAuthController::class, 'logout'])->name('logout-admin');
    //Dashboadrd
    Route::get('/halaman-utama', [AdminController::class, 'halamanUtama'])->name('halaman-dashboard');
    
    //Master Produk
    Route::prefix('produk')->group(function () {
        Route::get('/', [AdminProdukController::class, 'index'])->name('produk-index');
        Route::get('/create', [AdminProdukController::class, 'create'])->name('produk-create');
        Route::post('/store', [AdminProdukController::class, 'store'])->name('produk-store');
        Route::get('/edit/{kode}', [AdminProdukController::class, 'edit'])->name('produk-edit');
        Route::post('/update/{kode}', [AdminProdukController::class, 'update'])->name('produk-update');
        Route::get('/delete/{kode}', [AdminProdukController::class, 'delete'])->name('produk-delete');
        Route::get('/bom/{kode}', [AdminProdukController::class, 'bom'])->name('produk-bom');
    // Master Customer 
        Route::prefix('admin')->group(function () {
            Route::get('/customer', [AdminCustomerController::class, 'index'])->name('customer-index');
            Route::get('/customer/{kode}/delete', [AdminCustomerController::class, 'destroy'])->name('customer-destroy');

            Route::prefix('produksi')->group(function () {
                Route::get('/', [AdminProduksiController::class, 'index'])->name('produksi-index');
                Route::get('/terima/{invoice}/{kode_produk}', [AdminProduksiController::class, 'terima'])->name('produksi-terima');
                Route::get('/tolak/{invoice}', [AdminProduksiController::class, 'tolak'])->name('produksi-tolak');
                Route::get('/request-material-shortage', [AdminProduksiController::class, 'requestMaterialShortage'])->name('produksi-request-material-shortage');
            });
        });
    });
});

//Inventory
    // Rute untuk menampilkan daftar inventaris
    Route::get('/', [InventoryController::class, 'index'])->name('inventory-index');

    // Rute untuk menampilkan formulir tambah inventaris
    Route::get('/create', [InventoryController::class, 'create'])->name('inventory-create');

    // Rute untuk menyimpan inventaris baru
    Route::post('/', [InventoryController::class, 'store'])->name('inventory-store');

    // Rute untuk menampilkan formulir edit inventaris
    Route::get('/{kode}/edit', [InventoryController::class, 'edit'])->name('inventory-edit');

    // Rute untuk menyimpan perubahan inventaris
    Route::put('/{kode}', [InventoryController::class, 'update'])->name('inventory-update');

    // Rute untuk menghapus inventaris
    Route::delete('/{kode}', [InventoryController::class, 'destroy'])->name('inventory-destroy');

//DetailProduksi
Route::get('/produksi', [AdminDetailProduksiController::class, 'index'])->name('produksi-detail-index');
Route::get('/produksi/tolak/{inv}', [AdminDetailProduksiController::class, 'tolakPesanan'])->name('produksi-tolak');
Route::get('/produksi/terima/{inv}', [AdminDetailProduksiController::class, 'terimaPesanan'])->name('produksi-terima');