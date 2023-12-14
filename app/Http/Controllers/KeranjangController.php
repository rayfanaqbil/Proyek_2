<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function keranjang()
    {
        // Ambil data keranjang untuk user yang sedang login
        $keranjangItems = Keranjang::where('kode_customer', auth()->guard('customer')->user()->kode_customer)
            ->with('produk')
            ->get();

        return view('produk/keranjang', compact('keranjangItems'));
    }

    public function tambahKeranjang(Request $request)
    {
        $hal = $request->input('hal');
        $kodeCs = $request->input('kd_cs');
        $kodeProduk = $request->input('produk');

        $produk = Produk::where('kode_produk', $kodeProduk)->first();

        $namaProduk = $produk->nama;
        $kd = $produk->kode_produk;
        $harga = $produk->harga;

        if ($hal == 1) {
            $keranjang = Keranjang::where('kode_produk', $kodeProduk)
                ->where('kode_customer', $kodeCs)
                ->first();

            if ($keranjang) {
                $set = $keranjang->qty + 1;
                $keranjang->update(['qty' => $set]);
            } else {
                Keranjang::create([
                    'kode_customer' => $kodeCs,
                    'kode_produk' => $kd,
                    'nama_produk' => $namaProduk,
                    'qty' => 1,
                    'harga' => $harga,
                ]);
            }
        } else {
            $qty = $request->input('jml');
            $keranjang = Keranjang::where('kode_produk', $kodeProduk)
                ->where('kode_customer', $kodeCs)
                ->first();

            if ($keranjang) {
                $set = $keranjang->qty + $qty;
                $keranjang->update(['qty' => $set]);
            } else {
                Keranjang::create([
                    'kode_customer' => $kodeCs,
                    'kode_produk' => $kd,
                    'nama_produk' => $namaProduk,
                    'qty' => $qty,
                    'harga' => $harga,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Berhasil ditambahkan ke keranjang');
    }
}
