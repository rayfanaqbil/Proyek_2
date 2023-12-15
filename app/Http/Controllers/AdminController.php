<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function halamanUtama()
    {
        // pesanan baru
        $jml1 = DB::table('produksi')->where('terima', 0)->where('tolak', 0)->distinct()->count('invoice');

        // pesanan dibatalkan/ditolak
        $jml2 = DB::table('produksi')->where('tolak', 1)->distinct()->count('invoice');

        // pesanan diterima
        $jml3 = DB::table('produksi')->where('terima', 1)->distinct()->count('invoice');

        return view('admin/halaman_utama', compact('jml1', 'jml2', 'jml3'));
    }
}
