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
    Route::post('/logout', [AdminAuthController::class, 'logout']);
    Route::get('/halaman-utama', [AdminController::class, 'halamanUtama'])->name('halaman-dashboard');
});