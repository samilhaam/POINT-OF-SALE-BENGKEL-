<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_nota',
        'nama_pelanggan',
        'harga_jasa',
        'harga_barang',
        'total_harga'
    ];

    // Relasi ke detail transaksi (anak tabel)
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}