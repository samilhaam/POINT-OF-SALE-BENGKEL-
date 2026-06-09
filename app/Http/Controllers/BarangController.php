<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // 1. Tampilan Utama Stok Barang
    public function index()
    {
        $barangs = Barang::orderBy('created_at', 'desc')->get();
        return view('barang.index', compact('barangs'));
    }

    // 2. Tampilan Form Tambah Barang
    public function create()
    {
        return view('barang.create');
    }

    // 3. Proses Simpan Barang Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'nama_barang' => 'required',
            'stok'        => 'required|numeric|min:0',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('sukses', 'Barang baru berhasil ditambahkan, bos!');
    }

    // 4. Tampilan Form Edit Barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    // 5. Proses Simpan Perubahan Data Barang (Update)
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $id,
            'nama_barang' => 'required',
            'stok'        => 'required|numeric|min:0',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('sukses', 'Data barang berhasil diperbarui, bos!');
    }

    // 6. Proses Hapus Barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('sukses', 'Barang berhasil dihapus dari gudang!');
    }
}