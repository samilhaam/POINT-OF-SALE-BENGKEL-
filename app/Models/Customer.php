<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'license_plate', 'motorcycle_type'];

    // Hubungan ke Riwayat Antrean Servis
    public function serviceQueues(): HasMany
    {
        return $this->hasMany(ServiceQueue::class);
    }
}
