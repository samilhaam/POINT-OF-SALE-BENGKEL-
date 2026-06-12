<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    protected $fillable = [
        'username',
        'password',
        'name',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    // Hubungan ke Transaksi (Satu kasir bisa menangani banyak transaksi)
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}