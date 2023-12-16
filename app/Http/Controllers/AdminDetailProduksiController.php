<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDetailProduksiController extends Controller
{
    public function index(Request $request)
    {
        $invoices = $request->input('inv');
        $d_order = DB::table('produksi')->where('invoice', $invoices)->first();

        $sortage = DB::table('produksi')->where('cek', '1')->get();
        $cek_sor = $sortage->count();

        $cs = DB::table('customer')->where('kode_customer', $d_order->kode_customer)->first();

        $result = DB::table('produksi')
            ->select('invoice', 'kode_customer', 'status', 'kode_produk', 'qty', 'terima', 'tolak', 'cek')
            ->distinct()
            ->groupBy('invoice')
            ->get();

        $no = 1;
        $array = 0;
        $nama_material = [];

        return view('admin/detail_produk', compact('result', 'no', 'array', 'nama_material', 'd_order', 'cs', 'cek_sor'));
    }
}
