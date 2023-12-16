<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProduksiController extends Controller
{
    public function index()
{
    $sortage = DB::table('produksi')->where('cek', 1)->get();
    $cek_sor = $sortage->count();

    $produksis = DB::table('produksi')
        ->select('invoice', 'kode_customer', 'status', 'kode_produk', 'qty', 'terima', 'tolak', 'cek')
        ->groupBy('invoice', 'kode_customer', 'status', 'kode_produk', 'qty', 'terima', 'tolak', 'cek')
        ->get();

    $no = 1;
    $nama_material = [];

    return view('admin/produksi', compact('produksis', 'no', 'nama_material', 'cek_sor'));
}

    public function terima($invoice, $kode_produk)
    {
        // Logika untuk menerima pesanan

        return redirect()->route('produksi-index')->with('success', 'Pesanan berhasil diterima.');
    }

    public function tolak($invoice)
    {
        // Logika untuk menolak pesanan

        return redirect()->route('produksi-index')->with('success', 'Pesanan berhasil ditolak.');
    }

    public function requestMaterialShortage()
    {
        // Logika untuk request material shortage

        return redirect()->route('produksi-index')->with('success', 'Material shortage telah direquest.');
    }
}
