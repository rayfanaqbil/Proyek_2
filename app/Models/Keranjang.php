<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang'; // Nama tabel sesuai dengan tabel di database
    protected $primaryKey = 'id_keranjang'; // Kolom primary key

    // Daftar kolom yang dapat diisi (sesuaikan dengan struktur tabel)
    protected $fillable = ['id_keranjang', 'kode_customer', 'kode_produk','qty'];

    // Relasi ke model Produk (asumsi nama model Produk adalah Produk)
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
    }
}
