@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">HALO BOSKU</h2>
        <p class="text-muted">Selamat datang kembali! Berikut adalah ringkasan performa pendapatan Bengkel Sandi.</p>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase text-white-50 fw-bold mb-1">Minggu Ini</h6>
                        <h2 class="fw-bold mb-3">Rp {{ number_format($pendapatan_minggu) }}</h2>
                    </div>
                    <small class="text-white-50">Total omset Senin - Minggu saat ini</small>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase text-white-50 fw-bold mb-1">Bulan Ini</h6>
                        <h2 class="fw-bold mb-3">Rp {{ number_format($pendapatan_bulan) }}</h2>
                    </div>
                    <small class="text-white-50">Total akumulasi omset bulan berjalan</small>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card bg-dark text-white shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase text-white-50 fw-bold mb-1">Tahun Ini</h6>
                        <h2 class="fw-bold mb-3">Rp {{ number_format($pendapatan_tahun) }}</h2>
                    </div>
                    <small class="text-white-50">Total akumulasi omset sepanjang tahun</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-dark"> Transaksi Masuk Terakhir</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="p-3">Tanggal</th>
                        <th>No. Nota</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi_terbaru as $t)
                    <tr>
                        <td class="p-3">{{ $t->created_at->format('d-m-Y H:i') }}</td>
                        <td><span class="badge bg-secondary">{{ $t->nomor_nota }}</span></td>
                        <td><strong class="text-success">Rp {{ number_format($t->total_harga) }}</strong></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center p-4 text-muted">Belum ada transaksi yang tercatat hari ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection