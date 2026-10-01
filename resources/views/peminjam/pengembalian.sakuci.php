@extends('layouts.app')

@section('title', config('app.name') . ' -- Pengembalian Alat')

@section('content')
<div class="container-fluid py-4 px-4">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight">Pengembalian Alat</h3>
            <p class="text-body-secondary small mb-0">Daftar alat aktif yang sedang Anda pinjam dan siap untuk dikembalikan.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Nama Alat</th>
                            <th class="py-3 px-3">Jumlah</th>
                            <th class="py-3 px-3">Tgl Pinjam</th>
                            <th class="py-3 px-3">Status Saat Ini</th>
                            <th class="py-3 px-3 text-center">Aksi & Kondisi Pengembalian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($datap as $peminjaman)
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                            <td class="px-3">
                                <div class="fw-semibold text-body fs-7">{{ $peminjaman->alat->nama_alat ?? $peminjaman->alat->nama ?? 'Alat ID: ' . $peminjaman->id_alat }}</div>
                            </td>
                            <td class="px-3">
                                <span class="badge bg-body-tertiary text-body border font-monospace fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                    {{ $peminjaman->jumlah }} Unit
                                </span>
                            </td>
                            <td class="px-3">
                                <span class="text-body-secondary fs-7">{{ $peminjaman->tanggal_pinjam }}</span>
                            </td>
                            <td class="px-3">
                                <span class="badge bg-primary-subtle text-primary-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">{{ $peminjaman->status }}</span>
                            </td>
                            <td class="px-3 text-center">
                                <form action="{{ route('peminjam.pengembalian.store', ['id' => $peminjaman->id_peminjaman]) }}" method="POST" class="d-inline-block text-start p-2 border rounded bg-body-tertiary">
                                    @csrf
                                    <div class="mb-2">
                                        <label class="form-label fs-9 mb-0 fw-bold">Pilih Kondisi Alat:</label>
                                        <select name="kondisi_barang" class="form-select form-select-sm fs-8">
                                            <option value="Baik">Baik (Denda: Rp 0)</option>
                                            <option value="Rusak Ringan">Rusak Ringan (Denda: Rp 10.000)</option>
                                            <option value="Rusak Berat">Rusak Berat (Denda: Rp 50.000)</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success w-100 fs-8 py-1">Konfirmasi Pengembalian</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-body-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <i class="bi bi-check-circle fs-2 opacity-50 text-success"></i>
                                    <span class="fs-7">Tidak ada alat yang sedang Anda pinjam saat ini.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer bg-transparent py-3 border-top-0 d-flex justify-content-end">
            {!! $datap->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection