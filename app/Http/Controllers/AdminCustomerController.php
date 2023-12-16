<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = DB::table('customer')->orderBy('kode_customer', 'asc')->get();

        return view('admin/m_customer', compact('customers'));
    }

    public function destroy($kode)
    {
        DB::table('customer')->where('kode_customer', $kode)->delete();

        return redirect()->route('customer-index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
