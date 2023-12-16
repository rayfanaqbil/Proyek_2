<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BOM extends Model
{
    protected $table = 'bom_produk'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'kode_bom';
    public $incrementing = false; // Kode BOM tidak auto-increment
    protected $keyType = 'string'; // Kode BOM adalah string

    protected $fillable = [
        'kode_bom',
        'kode_material',
        'kode_produk',
        'kebutuhan',
    ];

    public $timestamps = false;

    // Definisikan relasi ke model Produk (jika dibutuhkan)
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
    }
}
