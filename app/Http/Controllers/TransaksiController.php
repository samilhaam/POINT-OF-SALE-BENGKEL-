<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $barangs = Barang::where('stok', '>', 0)->get();
        $transaksis = Transaksi::latest()->get();

        return view('transaksi.index', compact('barangs', 'transaksis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_nota' => 'required|unique:transaksis,nomor_nota',
            'harga_jasa' => 'required|numeric', // Menyesuaikan nama kolom kamu
            'barang_id' => 'required|array',
            'qty' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            $total_harga_barang = 0;
            $list_belanja = [];

            foreach ($request->barang_id as $key => $b_id) {
                $barang = Barang::findOrFail($b_id);
                $jumlah_beli = $request->qty[$key];

                if ($barang->stok < $jumlah_beli) {
                    return redirect()->back()->with('gagal', "Stok untuk barang {$barang->nama_barang} tidak mencukupi!");
                }

                $subtotal = $barang->harga_jual * $jumlah_beli;
                $total_harga_barang += $subtotal;

                $list_belanja[] = [
                    'barang_id' => $b_id,
                    'qty' => $jumlah_beli,
                    'subtotal' => $subtotal
                ];
            }

            // Hitung total bayar keseluruhan
            $total_bayar = $total_harga_barang + $request->harga_jasa;

            // SIMPAN ke tabel transaksis mengikuti kolom migration kamu
            $transaksi = Transaksi::create([
                'nomor_nota' => $request->nomor_nota,
                'nama_pelanggan' => $request->nama_pelanggan ?? 'Pelanggan Umum',
                'harga_jasa' => $request->harga_jasa,
                'harga_barang' => $total_harga_barang,
                'total_harga' => $total_bayar,
            ]);

            foreach ($list_belanja as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $item['barang_id'],
                    'qty' => $item['qty'],
                    'total_harga' => $item['subtotal'],
                ]);

                $barang = Barang::find($item['barang_id']);
                $barang->decrement('stok', $item['qty']);
            }

            DB::commit();
            return redirect()->route('transaksi.index')->with('sukses', 'Transaksi kasir berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('gagal', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
    public function cetak($id)
    {
        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);
        
        // Ambil detail belanjaan untuk nota ini
        $detail = DetailTransaksi::where('transaksi_id', $id)->get();

        return view('transaksi.cetak', compact('transaksi', 'detail'));
    }
    public function laporan(Request $request)
    {
        // Set default tanggal: dari tanggal 1 bulan ini sampai hari ini
        $tgl_awal = $request->tgl_awal ?? date('Y-m-01');
        $tgl_akhir = $request->tgl_akhir ?? date('Y-m-d');

        // Ambil data transaksi berdasarkan rentang tanggal
        $transaksis = Transaksi::whereBetween('created_at', [$tgl_awal . ' 00:00:00', $tgl_akhir . ' 23:59:59'])
                                ->orderBy('created_at', 'desc')
                                ->get();
        
        // Hitung total seluruh pendapatan di rentang tanggal tersebut
        $total_pendapatan = $transaksis->sum('total_harga');

        return view('transaksi.laporan', compact('transaksis', 'tgl_awal', 'tgl_akhir', 'total_pendapatan'));
    }
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        // 2. Hapus dulu semua detail barangnya agar database bersih
        $transaksi->detailTransaksi()->delete();

        // 3. Hapus data transaksi utamanya
        $transaksi->delete();
        // 4. Redirect kembali ke halaman transaksi dengan pesan sukses
        return redirect()->route('transaksi.index')->with('sukses', 'Transaksi berhasil dihapus!');
    }

    public function dashboard()
    {
        $hari_ini = Carbon::now();

        // 1. Rekap Minggu Ini (Senin sampai Minggu)
        $pendapatan_minggu = Transaksi::whereBetween('created_at', [
            $hari_ini->copy()->startOfWeek(), 
            $hari_ini->copy()->endOfWeek()
        ])->sum('total_harga');

        // 2. Rekap Bulan Ini
        $pendapatan_bulan = Transaksi::whereYear('created_at', $hari_ini->year)
                                     ->whereMonth('created_at', $hari_ini->month)
                                     ->sum('total_harga');

        // 3. Rekap Tahun Ini
        $pendapatan_tahun = Transaksi::whereYear('created_at', $hari_ini->year)
                                     ->sum('total_harga');

        // 4. Ambil 5 Transaksi Terakhir untuk pemanis dashboard
        $transaksi_terbaru = Transaksi::orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact('pendapatan_minggu', 'pendapatan_bulan', 'pendapatan_tahun', 'transaksi_terbaru'));
    }
}