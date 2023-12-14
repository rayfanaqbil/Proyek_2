<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function produk()
    {
        $produk = DB::table('produk')->get();

        return view('produk/produk', ['produk' => $produk]);
    }

    public function detail($kode_produk)
    {
        $produk = DB::table('produk')->where('kode_produk', $kode_produk)->first();

        return view('produk/detail_produk', ['produk' => $produk]);
    }
}
