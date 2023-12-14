<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('Auth/registrasi');
    }

    public function register(Request $request)
    {
        $lastCustomer = DB::table('customer')->orderByDesc('kode_customer')->first();
        $num = substr($lastCustomer->kode_customer, 1, 4);
        $add = (int) $num + 1;
        $format = "C" . sprintf('%04d', $add);

        $nama = $request->input('nama');
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $telp = $request->input('telp');
        $konfirmasi = $request->input('konfirmasi');

        $hash = Hash::make($password);

        if ($password == $konfirmasi) {
            $jml = DB::table('customer')->where('username', $username)->count();

            if ($jml > 0) {
                return redirect()->route('register_form')->with('error', 'USERNAME SUDAH DIGUNAKAN');
            }

            DB::table('customer')->insert([
                'kode_customer' => $format,
                'nama' => $nama,
                'email' => $email,
                'username' => $username,
                'password' => $hash,
                'telp' => $telp,
            ]);

            return redirect()->route('login_form')->with('success', 'REGISTER BERHASIL');
        } else {
            return redirect()->route('register_form')->with('error', 'KONFIRMASI PASSWORD TIDAK SAMA');
        }
    }
}
