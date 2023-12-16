<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin/index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Login berhasil, arahkan ke halaman admin
            return redirect()->route('halaman-dashboard');
        } else {
            // Login gagal, arahkan kembali ke halaman login dengan pesan kesalahan
            return redirect()->route('admin-login')->with('error', 'Username/password salah.');
        }
    }

    public function logout()
    {
        // Pastikan sesuai dengan cara Anda menyimpan status login
        if (auth()->guard('admin')->check()) {
            auth()->guard('admin')->logout();
        }

        return redirect('admin/login');
    }

    public function __construct()
    {
    $this->middleware('auth')->except(['showLoginForm', 'login', 'logout']);
    }
}
