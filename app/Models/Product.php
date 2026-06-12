<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['sku', 'name', 'category', 'cost_price', 'selling_price', 'stock', 'min_stock'];

    // Hubungan ke Detail Penjualan Produk
    public function transactionProducts(): HasMany
    {
        return $this->hasMany(TransactionProductDetail::class);
    }
}