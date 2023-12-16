<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = DB::table('inventory')->orderBy('kode_bk', 'asc')->get();
        return view('admin/inventory', compact('inventory'));
    }

    public function edit($kode)
    {
        $material = DB::table('inventory')->where('kode_bk', $kode)->first();
        return view('inventory.edit', compact('material'));
    }

    public function update(Request $request, $kode)
    {
        // Logika untuk update material
        // Implementasikan logika sesuai kebutuhan Anda

        return redirect()->route('inventory-index')->with('success', 'Data material berhasil diperbarui.');
    }

    public function destroy($kode)
    {
        $result = DB::table('inventory')->where('kode_bk', $kode)->delete();

        if ($result) {
            return redirect()->route('inventory-index')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->route('inventory-index')->with('error', 'Gagal menghapus data.');
        }
    }

    public function create()
    {
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        // Logika untuk menyimpan data material baru
        // Implementasikan logika sesuai kebutuhan Anda

        return redirect()->route('inventory-index')->with('success', 'Material baru berhasil ditambahkan.');
    }
}
