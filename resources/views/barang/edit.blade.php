@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">✏️ Edit Data Barang</h2>
        <p class="text-muted">Perbarui informasi data stok atau penyesuaian harga barang.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Kode Barang / Barcode</label>
                    <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" value="{{ old('kode_barang', $barang->kode_barang) }}" required>
                    @error('kode_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Jumlah Stok</label>
                        <input type="number" name="stok" class="form-control" value="{{ old('stok', $barang->stok) }}" min="0" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Harga Beli (Modal)</label>
                        <input type="number" name="harga_beli" class="form-control" value="{{ old('harga_beli', $barang->harga_beli) }}" min="0" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Harga Jual Toko</label>
                        <input type="number" name="harga_jual" class="form-control" value="{{ old('harga_jual', $barang->harga_jual) }}" min="0" required>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold"> Perbarui Data</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-light px-4 ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection