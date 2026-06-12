<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceQueue extends Model
{
    protected $fillable = ['customer_id', 'mechanic_id', 'complaint', 'status'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function mechanic(): BelongsTo
    {
        return $this->belongsTo(Mechanic::class);
    }

    // Hubungan 1-to-1 ke Transaksi (Satu antrean selesai jadi satu nota)
    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'queue_id');
    }
}