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

    public function tolakPesanan($inv)
    {
        $tolak = DB::table('produksi')
            ->where('invoice', $inv)
            ->update(['tolak' => 1, 'terima' => 2]);

        if ($tolak) {
            return redirect()->route('produksi-index')->with('success', 'Pesanan ditolak');
        } else {
            return redirect()->route('produksi-index')->with('error', 'Gagal menolak pesanan');
        }
    }

    public function terimaPesanan($inv)
    {
        $produksi = DB::table('produksi')->where('invoice', $inv)->get();

        foreach ($produksi as $row) {
            $kodep = $row->kode_produk;
            $bom_produk = DB::table('bom_produk')->where('kode_produk', $kodep)->get();

            foreach ($bom_produk as $row1) {
                $kodebk = $row1->kode_bk;
                $inventory = DB::table('inventory')->where('kode_bk', $kodebk)->first();

                $kebutuhan = $row1->kebutuhan;
                $qtyorder = $row->qty;
                $inven = $inventory->qty;
                $bom = ($kebutuhan * $qtyorder);
                $hasil = $inven - $bom;

                DB::table('inventory')->where('kode_bk', $kodebk)->update(['qty' => $hasil]);

                if ($hasil >= 0) {
                    DB::table('produksi')->where('invoice', $inv)->update(['terima' => 1, 'status' => 0]);
                    return redirect()->route('produksi-index')->with('success', 'Pesanan berhasil diterima, bahan baku telah dikurangkan');
                } else {
                    return redirect()->route('produksi-index')->with('error', 'Gagal menerima pesanan, stok bahan baku tidak mencukupi');
                }
            }
        }
    }
}
