<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Service;
use App\Models\Mechanic;
use App\Models\Transaction;
use App\Models\TransactionProductDetail;
use App\Models\TransactionServiceDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;

class PosKasir extends Component
{
    public $cart = [];
    public $mechanic_id = '';
    public $totalAmount = 0;

    // State baru untuk mengontrol tampilan Pop-up Nota Setelah Bayar
    public $showReceiptModal = false;
    public $receiptData = [];

    public function addToCart($id, $type)
    {
        if ($type === 'product') {
            $itemData = Product::find($id);
            if (!$itemData) return;
            $name = $itemData->name;
            $price = $itemData->selling_price;
            $maxStock = $itemData->stock;
        } else {
            $itemData = Service::find($id);
            if (!$itemData) return;
            $name = $itemData->name;
            $price = $itemData->price;
            $maxStock = 999;
        }

        $index = collect($this->cart)->search(function ($item) use ($id, $type) {
            return $item['id'] == $id && $item['type'] == $type;
        });

        if ($index !== false && $type === 'product') {
            if ($this->cart[$index]['qty'] < $maxStock) {
                $this->cart[$index]['qty']++;
            } else {
                session()->flash('error', "Stok {$name} hanya tersisa {$maxStock}!");
                return;
            }
        } elseif ($index === false) {
            $this->cart[] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'type' => $type,
                'qty' => 1
            ];
        } else {
            session()->flash('error', 'Jasa ini sudah ditambahkan!');
            return;
        }

        $this->calculateTotal();
        session()->forget('success');
    }

    public function removeFromCart($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart); 
        $this->calculateTotal();
        session()->forget('success');
    }

    public function calculateTotal()
    {
        $this->totalAmount = array_reduce($this->cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['qty']);
        }, 0);
    }

    public function processPayment()
    {
        if (empty($this->cart)) {
            session()->flash('error', 'Keranjang masih kosong!');
            return;
        }

        $hasService = collect($this->cart)->contains('type', 'service');
        if ($hasService && empty($this->mechanic_id)) {
            session()->flash('error', 'Ada Jasa Servis di dalam nota. Mohon pilih Mekanik yang bertugas terlebih dahulu!');
            return;
        }

        try {
            // Ambil nama mekanik untuk keperluan tampilan nota nanti
            $mechanicName = $this->mechanic_id ? Mechanic::find($this->mechanic_id)->name : '-';
            $invoiceNumber = 'INV-' . date('YmdHis'); 

            DB::transaction(function () use ($invoiceNumber) {
                // 1. Simpan Transaksi Utama
                $transaction = Transaction::create([
                    'invoice_number' => $invoiceNumber,
                    'mechanic_id'    => $this->mechanic_id ?: null, 
                    'user_id'        => 1, 
                    'total_amount'   => $this->totalAmount,
                    'payment_method' => 'cash',
                    'payment_status' => 'paid',
                ]);

                // 2. Simpan Detail Belanjaan
                foreach ($this->cart as $item) {
                    if ($item['type'] === 'product') {
                        $product = Product::find($item['id']);
                        if ($product) {
                            TransactionProductDetail::create([
                                'transaction_id' => $transaction->id,
                                'product_id'     => $item['id'],
                                'quantity'       => $item['qty'],
                                'price_at_sale'  => $item['price'],
                                'cost_at_sale'   => $product->purchase_price ?? $product->cost_price ?? 0, 
                            ]);

                            $product->decrement('stock', $item['qty']);
                        }

                    } elseif ($item['type'] === 'service') {
                        $serviceData = Service::find($item['id']);
                        if ($serviceData) {
                            // FIX EROR 1364: Mengambil komisi mekanik dari database.
                            // Jika kolom komisi di tabel 'services' kosong, otomatis dihitung 30% dari harga jasa sebagai cadangan aman.
                            $commissionPrice = $serviceData->mechanic_commission ?? $serviceData->commission ?? ($item['price'] * 0.3);

                            TransactionServiceDetail::create([
                                'transaction_id'     => $transaction->id,
                                'service_id'         => $item['id'],
                                'price_at_sale'      => $item['price'],
                                'mechanic_id'        => $this->mechanic_id ?: null,
                                'mechanic_commission'=> $commissionPrice, // Penyelamat dari crash database
                            ]);
                        }
                    }
                }
            });

            // 3. Amankan data keranjang saat ini ke dalam 'receiptData' sebelum keranjang dikosongkan
            $this->receiptData = [
                'invoice_number' => $invoiceNumber,
                'mechanic_name'  => $mechanicName,
                'items'          => $this->cart,
                'total'          => $this->totalAmount,
                'date'           => now()->format('d M Y H:i')
            ];

            // 4. Munculkan Pop-up Nota di Layar
            $this->showReceiptModal = true;

            // Bersihkan variabel kasir untuk transaksi selanjutnya
            $this->cart = [];
            $this->mechanic_id = '';
            $this->totalAmount = 0;

            session()->flash('success', 'Berhasil! Transaksi telah tersimpan ke database.');

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    // Fungsi untuk menutup Pop-up Nota
    public function closeReceiptModal()
    {
        $this->showReceiptModal = false;
        $this->receiptData = [];
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('components.pos-kasir', [
            'products' => Product::where('stock', '>', 0)->get(),
            'services' => Service::all(),
            'mechanics' => Mechanic::where('status', 'active')->get(),
        ]);
    }
}