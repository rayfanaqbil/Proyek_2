<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'produk'; 
    protected $primaryKey = 'kode_produk'; 

    
    protected $fillable = [
        'nama', 'harga', 'deskripsi', 'image',
    ];

    public $timestamps = false;

    
}
