<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Keranjang;
use App\Models\Produksi;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index($kode_cs)
    {
        $customer = Customer::where('kode_customer', $kode_cs)->first();
        $keranjangItems = Keranjang::where('kode_customer', $kode_cs)->get();

        return view('produk/checkout', compact('customer', 'keranjangItems'));
    }

    public function process(Request $request)
    {
        try {
            DB::beginTransaction();

            $kode_cs = $request->input('kode_cs');
            $nama = $request->input('nama');
            $prov = $request->input('prov');
            $kota = $request->input('kota');
            $alamat = $request->input('almt');
            $kopos = $request->input('kopos');
            $tanggal = now();

            $format = $this->generateInvoice();

            $keranjangItems = Keranjang::where('kode_customer', $kode_cs)->get();

            foreach ($keranjangItems as $item) {
                $order = Produksi::create([
                    'invoice' => $format,
                    'kode_customer' => $kode_cs,
                    'kode_produk' => $item->kode_produk,
                    'nama_produk' => $item->produk->nama,
                    'qty' => $item->qty,
                    'harga' => $item->produk->harga,
                    'status' => 'Pesanan Baru',
                    'tanggal' => $tanggal,
                    'provinsi' => $prov,
                    'kota' => $kota,
                    'alamat' => $alamat,
                    'kode_pos' => $kopos,
                ]);
            }

            Keranjang::where('kode_customer', $kode_cs)->delete();

            DB::commit();

            return redirect()->route('selesai')->with('success', 'Pesanan berhasil ditempatkan!');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('keranjang')->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    private function generateInvoice()
    {
        $latestInvoice = Produksi::latest()->first();

        if ($latestInvoice) {
            $num = (int) substr($latestInvoice->invoice, 3) + 1;
        } else {
            $num = 1;
        }

        return 'INV' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }
}
