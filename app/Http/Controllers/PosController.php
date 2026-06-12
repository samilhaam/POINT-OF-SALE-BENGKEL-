<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Service;
use App\Models\Mechanic;

class PosController extends Controller
{
    // Method untuk menampilkan halaman utama kasir
    public function index()
    {
        // Mengambil semua produk yang stoknya masih ada (> 0)
        $products = Product::where('stock', '>', 0)->get();
        
        // Mengambil semua jasa servis
        $services = Service::all();

        // Mengambil semua mekanik yang statusnya aktif
        $mechanics = Mechanic::where('status', 'active')->get();

        // Mengirimkan data-data tersebut ke file tampilan (view) bernama 'pos.index'
        return view('pos.index', compact('products', 'services', 'mechanics'));
    }

    // Nanti kita akan tambahkan method store() di sini untuk memproses penyimpanan transaksi ke database
}