@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2> Laporan Pendapatan Bengkel</h2>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('transaksi.laporan') }}" method="GET" class="row align-items-end">
                <div class="col-md-4">
                    <label>Dari Tanggal</label>
                    <input type="date" name="tgl_awal" class="form-control" value="{{ $tgl_awal }}" required>
                </div>
                <div class="col-md-4">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="tgl_akhir" class="form-control" value="{{ $tgl_akhir }}" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">🔍 Filter Laporan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Rincian Transaksi</div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="p-3">Tanggal</th>
                        <th>No. Nota</th>
                        <th>Pendapatan Jasa</th>
                        <th>Pendapatan Barang</th>
                        <th>Total Pemasukan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $t)
                    <tr>
                        <td class="p-3">{{ $t->created_at->format('d-m-Y H:i') }}</td>
                        <td><strong>{{ $t->nomor_nota }}</strong></td>
                        <td>Rp {{ number_format($t->harga_jasa) }}</td>
                        <td>Rp {{ number_format($t->harga_barang) }}</td>
                        <td><span class="badge bg-success">Rp {{ number_format($t->total_harga) }}</span></td>
                        <td class="text-center">
                            <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin bos ingin menghapus nota {{ $t->nomor_nota }} ini? Total omset akan berkurang.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center p-3 text-muted">Tidak ada transaksi pada rentang tanggal ini.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-light fw-bold">
                    <tr>
                        <td colspan="4" class="text-end text-uppercase p-3">Total Omset Keseluruhan :</td>
                        <td colspan="2" class="text-success fs-5">Rp {{ number_format($total_pendapatan) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('sukses'))
        <script>
            Swal.fire({
                title: 'Berhasil Dihapus!',
                text: "{{ session('sukses') }}",
                icon: 'success',
                confirmButtonColor: '#198754',
                confirmButtonText: 'Siap, Bos!'
            });
        </script>
    @endif
@endsection