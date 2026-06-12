<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = ['name', 'price'];

    // Hubungan ke Detail Jasa Transaksi
    public function transactionServices(): HasMany
    {
        return $this->hasMany(TransactionServiceDetail::class);
    }
}
