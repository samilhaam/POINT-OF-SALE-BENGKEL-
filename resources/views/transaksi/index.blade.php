@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🛒 Kasir Transaksi Bengkel</h2>
    </div>

    @if(session('sukses'))
        <div class="alert alert-success">{{ session('sukses') }}</div>
    @endif
    @if(session('gagal'))
        <div class="alert alert-danger">{{ session('gagal') }}</div>
    @endif

    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">Input Transaksi Baru</div>
                <div class="card-body">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label>Nomor Nota</label>
                            <input type="text" name="nomor_nota" class="form-control" value="INV-{{ rand(100000, 999999) }}" readonly>
                        </div>
                        
                        <div class="mb-2">
                            <label>Tanggal Transaksi</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" disabled>
                        </div>
                        
                        <div class="mb-2">
                            <label>Harga Jasa Montir / Servis (Rp)</label>
                            <input type="number" name="harga_jasa" class="form-control" placeholder="0" required>
                        </div>

                        <hr>
                        <h5>Pilih Barang</h5>
                        <div class="mb-2">
                            <label>Oli / Sparepart</label>
                            <select name="barang_id[]" class="form-control" required>
                                <option value="">-- Pilih Oli / Sparepart --</option>
                                @foreach($barangs as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama_barang }} (Sisa: {{ $b->stok }}) | Rp {{ number_format($b->harga_jual) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Jumlah Beli (Qty)</label>
                            <input type="number" name="qty[]" class="form-control" value="1" min="1" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Simpan Transaksi</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">Riwayat Transaksi Masuk</div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Nota</th>
                                <th>Tanggal</th>
                                <th>Jasa</th>
                                <th>Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $t)
                            <tr>
                                <td><strong>{{ $t->nomor_nota }}</strong></td>
                                <td>{{ $t->created_at->format('d-m-Y H:i') }}</td>
                                <td>Rp {{ number_format($t->harga_jasa) }}</td>
                                <td><span class="badge bg-success" style="font-size: 14px;">Rp {{ number_format($t->total_harga) }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center p-3 text-muted">Belum ada riwayat transaksi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection