@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">➕ Tambah Barang Baru</h2>
        <p class="text-muted">Masukkan data sparepart atau oli baru ke sistem gudang.</p>
    </div>

    <div class="card shadow-sm max-width-600">
        <div class="card-body p-4">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Kode Barang / Barcode</label>
                    <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" value="{{ old('kode_barang') }}" placeholder="Contoh: OLI-MPX2" required>
                    @error('kode_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" placeholder="Contoh: Oli Mesin AHM MPX 2 0.8L" required>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Jumlah Stok Pertama</label>
                        <input type="number" name="stok" class="form-control" value="{{ old('stok', 0) }}" min="0" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Harga Beli (Modal)</label>
                        <input type="number" name="harga_beli" class="form-control" value="{{ old('harga_beli') }}" min="0" placeholder="Rp" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Harga Jual Toko</label>
                        <input type="number" name="harga_jual" class="form-control" value="{{ old('harga_jual') }}" min="0" placeholder="Rp" required>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success px-4 fw-bold">💾 Simpan Barang</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-light px-4 ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection