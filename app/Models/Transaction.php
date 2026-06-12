<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom untuk diisi data (Mass Assignment)
    protected $guarded = [];
}