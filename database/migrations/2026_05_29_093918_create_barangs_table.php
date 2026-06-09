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
    Schema::create('barangs', function (Blueprint $table) {
        $table->id();
        $table->string('kode_barang')->unique(); // Sudah diperbaiki typo-nya
        $table->string('nama_barang');
        $table->integer('stok');
        $table->integer('stok_minimum')->default(2); // Diubah ke integer agar sinkron dengan stok
        $table->bigInteger('harga_beli');   // Diubah ke bigInteger agar konsisten
        $table->bigInteger('harga_jual');   // Diubah ke bigInteger untuk nominal uang besar
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
