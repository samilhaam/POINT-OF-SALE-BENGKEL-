<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'stok',
        'harga_beli',
        'harga_jual'
    ];

    // Relasi ke detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}