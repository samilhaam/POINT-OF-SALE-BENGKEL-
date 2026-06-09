<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'qty',
        'total_harga'
    ];

    // Hubungan balik ke transaksi induk
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    // Hubungan balik ke data barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}