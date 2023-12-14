<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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
Route::get('/produk/{produk}', [ProdukController::class, 'detail'])->name('produkdetail');

//Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register_form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

//Login
Route::get('/login', [LoginController::class, 'showFormLogin'])->name('login_form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth:customer');
