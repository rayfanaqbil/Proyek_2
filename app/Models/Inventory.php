<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory'; // Sesuaikan dengan nama tabel yang digunakan di database

    protected $fillable = ['kode_bk', 'nama', 'qty', 'satuan', 'harga', 'tanggal']; // Sesuaikan dengan kolom-kolom yang ada di tabel

    // Jika ada relasi dengan tabel lain, definisikan di sini
    // Contoh:
    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
