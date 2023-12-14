<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showFormLogin()
    {
        return view('Auth/login_user');
    }

    public function login(Request $request)
    {
    $credentials = $request->only('username', 'password');
 
    if (Auth::guard('customer')->attempt($credentials)) {
        $user = Auth::guard('customer')->user();
        session(['user' => $user->nama, 'kd_cs' => $user->kode_customer]);

        return redirect()->route('home');
    }
 
    return redirect('Auth/login_user')->with('error', 'USERNAME/PASSWORD SALAH');
    }

    public function logout()
    {
        Auth::logout(); // Melakukan proses logout

        return redirect()->route('login_form')->with('success', 'Berhasil Logout');
    }
}
