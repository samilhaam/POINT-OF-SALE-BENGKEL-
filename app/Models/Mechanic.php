<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mechanic extends Model
{
    protected $fillable = ['name', 'phone', 'commission_type', 'commission_value', 'status'];

    // Hubungan ke Antrean Servis
    public function serviceQueues(): HasMany
    {
        return $this->hasMany(ServiceQueue::class);
    }

    // Hubungan ke Detail Jasa Transaksi (Untuk tracking performa & komisi)
    public function transactionServices(): HasMany
    {
        return $this->hasMany(TransactionServiceDetail::class);
    }
}
