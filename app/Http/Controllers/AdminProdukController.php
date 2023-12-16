<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\BOM;
use App\Models\Inventory;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\DB;

class AdminProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('Admin/mproduk', compact('produk'));
    }
    public function create()
{
    // Logika untuk menghasilkan kode produk
    $num = (int) Produk::max('kode_produk') + 1;
    $format = "P" . str_pad($num, 4, '0', STR_PAD_LEFT);  // $format adalah string
    $num = 123;  // $num adalah integer

    $result = (int)$format + $num;

    $jml = count(Inventory::all());
    // Ambil data material dari model atau sumber data lainnya
    $materials = Inventory::all(); // Gantilah dengan model atau sumber data yang sesuai

    return view('admin/tm_produk', compact('format', 'materials', 'jml'));
}

public function store(Request $request)
{
    // Validasi data masukan
    $request->validate([
        // ... (Tambahkan validasi sesuai dengan kebutuhan)
    ]);

    // Simpan data produk baru
    $produk = new Produk();
    $produk->kode_produk = $request->kode;
    $produk->nama = $request->nama;
    $produk->harga = $request->harga;
    $produk->deskripsi = $request->desk;

    // Handle upload gambar produk (pastikan folder storage di-link ke public)
    if ($request->hasFile('files')) {
        $gambar = $request->file('files');
        $gambarNama = uniqid() . '.' . $gambar->getClientOriginalExtension();
        $gambar->storeAs('public/produk', $gambarNama);
        $produk->image = $gambarNama;
    }

    $produk->save();

    // Simpan data BOM
    foreach ($request->material as $index => $kodeMaterial) {
        $bom = new BOM();
        $bom->kode_bom = $this->generateKodeMaterial(BOM::orderBy('kode_bom', 'desc')->first()->kode_bom);
        $bom->kode_material = $kodeMaterial;
        $bom->kode_produk = $request->kode;
        $bom->kebutuhan = $request->keb[$index];
        $bom->save();
    }

    return redirect()->route('produk-index')->with('success', 'Produk berhasil ditambahkan!');
}

private function generateKodeMaterial($lastKode)
{
    $num = substr($lastKode, 1, 4);
    $add = (int)$num + 1;
    $format = 'B' . str_pad($add, 4, '0', STR_PAD_LEFT);
    return $format;
}

public function edit($kode)
{
    $data['produk'] = Produk::where('kode_produk', $kode)->first();

    // Pastikan produk ditemukan sebelum menggunakan data di view
    if (!$data['produk']) {
        abort(404); // atau tangani kasus ketika produk tidak ditemukan
    }

    $data['inventory'] = Inventory::orderBy('kode_bk', 'asc')->get();
    $data['bom_produk'] = BOM::where('kode_produk', $kode)->get();

    return view('admin/produk_edit', compact('data'));
}
public function update(Request $request)
{
    $kode = $request->input('kode');
    $nm_produk = $request->input('nama');
    $harga = $request->input('harga');
    $desk = $request->input('desk');
    $nama_gambar = $request->file('files');

    // Logika untuk mengupdate produk
    $produk = Produk::where('kode_produk', $kode)->first();

    // Periksa ketersediaan produk
    if (!$produk) {
        abort(404, 'Produk tidak ditemukan');
    }

    // Update data produk
    $produk->nama = $nm_produk;
    $produk->deskripsi = $desk;
    $produk->harga = $harga;

    // Pembaruan gambar
    if ($nama_gambar) {
        $gambar_path = 'image/produk/' . $produk->image;

        // Hapus gambar lama
        if (File::exists($gambar_path)) {
            File::delete($gambar_path);
        }

        // Upload gambar baru
        $namaGambarBaru = uniqid() . '.' . $nama_gambar->getClientOriginalExtension();
        $nama_gambar->move(public_path('image/produk'), $namaGambarBaru);

        $produk->image = $namaGambarBaru;
    }

    $produk->save();

    // Update BOM
    $kd_material = $request->input('material');
    $keb = $request->input('keb');

    foreach ($kd_material as $key => $material) {
        // Gunakan metode updateOrCreate untuk menghindari duplikasi data
        BOM::updateOrCreate(
            [
                'kode_produk' => $kode,
                'kode_bk' => $material,
            ],
            [
                'kebutuhan' => $keb[$key],
            ]
        );
    }

    return redirect()->route('produk-index')->with('success', 'Produk berhasil diupdate');
}


public function delete($kode)
    {
        // Ambil data produk
        $produk = Produk::where('kode_produk', $kode)->first();

        // Hapus gambar produk
        $gambarPath = public_path('image/produk/' . $produk->image);
        if (File::exists($gambarPath)) {
            File::delete($gambarPath);
        }

        // Hapus BOM produk
        BOM::where('kode_produk', $kode)->delete();

        // Hapus produk
        $produk->delete();

        return redirect()->route('produk-index')->with('success', 'Data berhasil dihapus');
    }

    public function bom($kode)
{
    $produk = DB::select("SELECT * FROM produk WHERE kode_produk = ?", [$kode]);

    // Periksa apakah produk ditemukan
    if (empty($produk)) {
        abort(404, 'Produk tidak ditemukan');
    }

    $bom_produk = DB::select("SELECT i.nama as nama, b.kebutuhan as jml, i.satuan as satu FROM bom_produk b JOIN inventory i on b.kode_bk=i.kode_bk where b.kode_produk = ?", [$kode]);

    return view('admin/bom_produk', compact('produk', 'bom_produk'));
}



}
