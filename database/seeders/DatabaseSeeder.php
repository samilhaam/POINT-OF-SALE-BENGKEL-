<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Mechanic;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceQueue;
use App\Models\Transaction;
use App\Models\TransactionProductDetail;
use App\Models\TransactionServiceDetail;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Data Users (Untuk Login)
        $owner = User::create([
            'username' => 'owner',
            'password' => Hash::make('password'), // Password default: password
            'name' => 'Budi Owner',
            'role' => 'owner',
        ]);

        $kasir = User::create([
            'username' => 'kasir',
            'password' => Hash::make('password'),
            'name' => 'Siti Kasir',
            'role' => 'kasir',
        ]);

        // 2. Data Mekanik
        $mekanik1 = Mechanic::create([
            'name' => 'Ujang Tarsono',
            'phone' => '081234567890',
            'commission_type' => 'percentage',
            'commission_value' => 40.00, // Mekanik dapat 40% dari harga jasa
            'status' => 'active',
        ]);

        $mekanik2 = Mechanic::create([
            'name' => 'Asep Knalpot',
            'phone' => '089876543210',
            'commission_type' => 'fixed',
            'commission_value' => 15000.00, // Komisi tetap Rp 15.000 per jasa
            'status' => 'active',
        ]);

        // 3. Data Pelanggan
        $pelanggan1 = Customer::create([
            'name' => 'Andi Pratama',
            'phone' => '085512341234',
            'license_plate' => 'B 1234 ABC',
            'motorcycle_type' => 'Honda Vario 150',
        ]);

        $pelanggan2 = Customer::create([
            'name' => 'Rina Melati',
            'phone' => '087798769876',
            'license_plate' => 'D 5678 DEF',
            'motorcycle_type' => 'Yamaha NMAX',
        ]);

        // 4. Data Produk / Sparepart
        $oli = Product::create([
            'sku' => 'PRD-001',
            'name' => 'Oli Yamalube Matic 800ml',
            'category' => 'Oli',
            'cost_price' => 45000,
            'selling_price' => 55000,
            'stock' => 25,
            'min_stock' => 5,
        ]);

        $kampas = Product::create([
            'sku' => 'PRD-002',
            'name' => 'Kampas Rem Depan Honda Genuine',
            'category' => 'Sparepart',
            'cost_price' => 35000,
            'selling_price' => 50000,
            'stock' => 10,
            'min_stock' => 3,
        ]);

        $ban = Product::create([
            'sku' => 'PRD-003',
            'name' => 'Ban FDR 90/90-14 Tubeless',
            'category' => 'Ban',
            'cost_price' => 180000,
            'selling_price' => 220000,
            'stock' => 8,
            'min_stock' => 2,
        ]);

        // 5. Data Jasa Servis
        $servisRingan = Service::create([
            'name' => 'Servis Ringan / Injeksi',
            'price' => 75000,
        ]);

        $gantiOli = Service::create([
            'name' => 'Jasa Ganti Oli',
            'price' => 10000,
        ]);

        // ====================================================================
        // SIMULASI 1 TRANSAKSI LENGKAP (Pelanggan Servis + Beli Oli + Kampas Rem)
        // ====================================================================

        // A. Pelanggan masuk antrean
        $antrean = ServiceQueue::create([
            'customer_id' => $pelanggan1->id,
            'mechanic_id' => $mekanik1->id, // Dikerjakan oleh Ujang
            'complaint' => 'Tarikan motor berat dan rem depan blong',
            'status' => 'completed',
        ]);

        // B. Transaksi dibuat oleh Kasir
        $transaksi = Transaction::create([
            'invoice_number' => 'INV-' . date('Ymd') . '-001',
            'queue_id' => $antrean->id,
            'user_id' => $kasir->id,
            'total_amount' => 180000, // Total: Servis(75k) + Oli(55k) + Kampas(50k)
            'payment_method' => 'cash',
            'payment_status' => 'paid',
            'created_at' => Carbon::now(),
        ]);

        // C. Detail Sparepart yang dibeli di transaksi tersebut
        TransactionProductDetail::create([
            'transaction_id' => $transaksi->id,
            'product_id' => $oli->id,
            'quantity' => 1,
            'price_at_sale' => $oli->selling_price,
            'cost_at_sale' => $oli->cost_price,
        ]);

        TransactionProductDetail::create([
            'transaction_id' => $transaksi->id,
            'product_id' => $kampas->id,
            'quantity' => 1,
            'price_at_sale' => $kampas->selling_price,
            'cost_at_sale' => $kampas->cost_price,
        ]);

        // D. Detail Jasa Servis di transaksi tersebut (beserta hitungan komisi)
        // Komisi Ujang = 40% dari harga Servis Ringan (75.000) = 30.000
        TransactionServiceDetail::create([
            'transaction_id' => $transaksi->id,
            'service_id' => $servisRingan->id,
            'mechanic_id' => $mekanik1->id,
            'price_at_sale' => $servisRingan->price,
            'mechanic_commission' => ($mekanik1->commission_value / 100) * $servisRingan->price, 
        ]);
    }
}