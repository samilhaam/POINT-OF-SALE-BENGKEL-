<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang; 

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        // Data suku cadang lengkap dengan kode_barang dan harga_beli
        $daftar_suku_cadang = [
            ['kode_barang' => 'OLI-MPX2', 'nama_barang' => 'Oli Mesin AHM MPX 2 0.8L', 'harga_beli' => 47000, 'harga_jual' => 55000, 'stok' => 24],
            ['kode_barang' => 'OLI-YMLM', 'nama_barang' => 'Oli Mesin Yamalube Matic 0.8L', 'harga_beli' => 38000, 'harga_jual' => 45000, 'stok' => 20],
            ['kode_barang' => 'OLI-GRDN', 'nama_barang' => 'Oli Gardan AHM (Transmission Gear Oil)', 'harga_beli' => 15000, 'harga_jual' => 18000, 'stok' => 15],
            ['kode_barang' => 'BSI-NGK9', 'nama_barang' => 'Busi NGK CPR9EA-9 (Busi Standar Matic)', 'harga_beli' => 18000, 'harga_jual' => 25000, 'stok' => 30],
            ['kode_barang' => 'KMP-DPN44', 'nama_barang' => 'Kampas Rem Depan Cakram (K44) Honda', 'harga_beli' => 45000, 'harga_jual' => 60000, 'stok' => 10],
            ['kode_barang' => 'KMP-BLKYM', 'nama_barang' => 'Kampas Rem Belakang Tromol Yamaha', 'harga_beli' => 38000, 'harga_jual' => 50000, 'stok' => 12],
            ['kode_barang' => 'VBL-K44', 'nama_barang' => 'V-Belt Honda Beat FI / Scoopy (K44)', 'harga_beli' => 110000, 'harga_jual' => 135000, 'stok' => 8],
            ['kode_barang' => 'VBL-2DP', 'nama_barang' => 'V-Belt Yamaha NMAX (2DP)', 'harga_beli' => 125000, 'harga_jual' => 150000, 'stok' => 5],
            ['kode_barang' => 'BAN-IRC90', 'nama_barang' => 'Ban Tubeless IRC 90/90-14 (Belakang)', 'harga_beli' => 185000, 'harga_jual' => 220000, 'stok' => 6],
            ['kode_barang' => 'BAN-FDR80', 'nama_barang' => 'Ban Tubeless Federal 80/90-14 (Depan)', 'harga_beli' => 160000, 'harga_jual' => 195000, 'stok' => 6],
            ['kode_barang' => 'FLT-K59', 'nama_barang' => 'Filter Udara Vario 125/150 (K59)', 'harga_beli' => 35000, 'harga_jual' => 45000, 'stok' => 15],
            ['kode_barang' => 'AKI-GS4V', 'nama_barang' => 'Aki Kering GS Astra GTZ4V / MTZ5S', 'harga_beli' => 200000, 'harga_jual' => 240000, 'stok' => 4],
            ['kode_barang' => 'GER-KTM', 'nama_barang' => 'Gear Set / Rantai Supra X 125 (KTM)', 'harga_beli' => 150000, 'harga_jual' => 185000, 'stok' => 3],
            ['kode_barang' => 'LMP-OSH6', 'nama_barang' => 'Lampu Depan LED Osram H6', 'harga_beli' => 50000, 'harga_jual' => 65000, 'stok' => 20],
            ['kode_barang' => 'RAD-AHM', 'nama_barang' => 'Cairan Radiator Coolant AHM 1L', 'harga_beli' => 28000, 'harga_jual' => 35000, 'stok' => 10],
        ];

        foreach ($daftar_suku_cadang as $item) {
            Barang::create($item);
        }
    }
}