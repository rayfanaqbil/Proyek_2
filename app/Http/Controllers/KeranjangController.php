<?php

namespace App\Http\Controllers;


use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KeranjangController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $kode_cs = auth()->user()->kode_customer;
            $jml = Keranjang::where('kode_customer', $kode_cs)->count();

            if ($jml > 0) {
                $keranjangItems = Keranjang::where('kode_customer', $kode_cs)
                    ->join('produk', 'keranjang.kode_produk', '=', 'produk.kode_produk')
                    ->select('keranjang.id_keranjang as keranjang', 'keranjang.qty as jml', 'produk.image as gambar', 'produk.harga as hrg', 'produk.nama as nama')
                    ->get();

                $no = 1;
                $hasil = 0;

                return view('produk/keranjang', compact('keranjangItems', 'no', 'hasil'));
            } else {
                return view('produk/keranjang', ['kosong' => true]);
            }
        } else {
            return view('produk/keranjang', ['belumLogin' => true]);
        }
    }

    public function update(Request $request)
    {
        $id_keranjang = $request->input('id');
        $qty = $request->input('qty');

        Keranjang::where('id_keranjang', $id_keranjang)->update(['qty' => $qty]);

        return redirect()->route('keranjang')->with('success', 'Keranjang berhasil diperbarui');
    }

        public function delete($id_keranjang)
    {
        try {
            // Menambahkan pernyataan log untuk melihat nilai $id_keranjang
            Log::info('Deleting item from keranjang. ID: ' . $id_keranjang);

            // Pastikan bahwa nilai $id_keranjang ada sebelum mencoba menghapus
            if (!$id_keranjang) {
                throw new \Exception('ID Keranjang tidak valid.');
            }

            // Menghapus item dari tabel Keranjang
            Keranjang::where('id_keranjang', $id_keranjang)->delete();

            // Menambahkan pernyataan log setelah penghapusan
            Log::info('Item deleted from keranjang. ID: ' . $id_keranjang);

            // Mengalihkan kembali ke halaman keranjang dengan pesan sukses
            return redirect()->route('keranjang')->with('success', 'Produk dihapus');
        } catch (\Exception $e) {
            // Menambahkan log jika terjadi kesalahan
            Log::error('Error deleting item from keranjang: ' . $e->getMessage());

            // Mengalihkan kembali ke halaman keranjang dengan pesan error
            return redirect()->route('keranjang')->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
}