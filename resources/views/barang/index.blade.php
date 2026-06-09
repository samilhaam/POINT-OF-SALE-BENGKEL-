@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manajemen Stok Barang</h2>
        <a href="{{ route('barang.create') }}" class="btn btn-success fw-bold shadow-sm">➕ Tambah Barang Baru</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white fw-bold">Daftar Inventaris Gudang</div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="p-3">Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Harga Beli (Modal)</th>
                        <th>Harga Jual</th>
                        <th class="text-center" width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $b)
                    <tr>
                        <td class="p-3"><strong>{{ $b->kode_barang }}</strong></td>
                        <td>{{ $b->nama_barang }}</td>
                        <td>
                            <span class="badge {{ $b->stok <= 5 ? 'bg-danger' : 'bg-secondary' }} px-2 py-1">
                                {{ $b->stok }} Pcs
                            </span>
                        </td>
                        <td>Rp {{ number_format($b->harga_beli) }}</td>
                        <td><span class="text-success fw-bold">Rp {{ number_format($b->harga_jual) }}</span></td>
                        <td class="text-center">
                            <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-warning btn-sm me-1 fw-bold text-dark">✏️ Edit</a>
                            
                            <form action="{{ route('barang.destroy', $b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus {{ $b->nama_barang }} dari gudang?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm fw-bold">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center p-4 text-muted">Belum ada barang di gudang. Silakan tambah baru!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('sukses'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('sukses') }}",
                icon: 'success',
                confirmButtonColor: '#198754'
            });
        </script>
    @endif
@endsection