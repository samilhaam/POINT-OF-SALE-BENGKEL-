<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_nota')->unique();
        $table->string('nama_pelanggan')->nullable();
        $table->bigInteger('harga_jasa')->default(0);   // Menggunakan bigInteger
        $table->bigInteger('harga_barang')->default(0); // Menggunakan bigInteger
        $table->bigInteger('total_harga')->default(0);  // Total harga jasa + total harga barang
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
