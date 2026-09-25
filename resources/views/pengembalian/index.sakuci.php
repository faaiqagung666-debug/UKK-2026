@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Pengembalian Alat')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container-fluid py-4 px-4">
    
    <!-- Header Halaman & Tombol Tambah -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-primary-subtle text-primary px-2.5 py-1 rounded-pill fw-semibold small">
                    <i class="bi bi-arrow-return-left me-1"></i> Pengembalian
                </span>
            </div>
            <h3 class="fw-bold mb-1 text-body">Daftar Pengembalian Alat</h3>
            <p class="text-body-secondary small mb-0">Kelola riwayat pengembalian inventaris alat sekolah, pinalti/denda, dan kondisi barang.</p>
        </div>
        <a href="{{ route('pengembalian.create') }}" class="btn btn-primary fw-semibold px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Tambah Pengembalian Baru</span>
        </a>
    </div>

    <!-- Alert Notifikasi Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                <div class="small fw-medium">{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Pembungkus Tabel -->
    <div class="card border-0 bg-body-tertiary shadow-sm rounded-4 overflow-hidden mb-4">
        
        <!-- Header Card -->
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-journal-check text-primary fs-5"></i>
                <h6 class="fw-bold mb-0 text-body">Data Transaksi Pengembalian</h6>
            </div>
            <span class="badge bg-body text-body-secondary border px-3 py-1.5 rounded-pill small fw-normal">
                Total: {{ count($datap) }} Data
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">ID Pinjam</th>
                            <th class="py-3 px-3">Tgl Pengembalian</th>
                            <th class="py-3 px-3">Keterlambatan</th>
                            <th class="py-3 px-3">Denda</th>
                            <th class="py-3 px-3">Kondisi Barang</th>
                            <th class="py-3 px-3">Catatan</th>
                            <th class="py-3 px-4 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @php $no = 1; @endphp
                        @forelse ($datap as $pengembalian)
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                            
                            <!-- ID Pinjam -->
                            <td class="px-3">
                                <span class="badge bg-primary-subtle text-primary fw-bold px-2.5 py-1.5 rounded-2 fs-8">
                                    #{{ $pengembalian->id_peminjaman }}
                                </span>
                            </td>

                            <!-- Tanggal Pengembalian -->
                            <td class="px-3">
                                <span class="text-body fw-medium fs-7">
                                    <i class="bi bi-calendar-event text-body-secondary me-1"></i>
                                    {{ $pengembalian->tanggal_pengembalian }}
                                </span>
                            </td>

                            <!-- Status Terlambat -->
                            <td class="px-3">
                                @if($pengembalian->terlambat_hari > 0)
                                    <span class="badge bg-danger-subtle text-danger fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $pengembalian->terlambat_hari }} Hari
                                    </span>
                                @else
                                    <span class="badge bg-success-subtle text-success fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-check-circle-fill me-1"></i>Tepat Waktu
                                    </span>
                                @endif
                            </td>

                            <!-- Denda -->
                            <td class="px-3">
                                @if(($pengembalian->denda ?? 0) > 0)
                                    <span class="text-danger fw-bold fs-7">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-body-secondary fs-7">-</span>
                                @endif
                            </td>

                            <!-- Kondisi Barang -->
                            <td class="px-3">
                                @php
                                    $kondisi = strtolower($pengembalian->kondisi_barang ?? 'baik');
                                @endphp
                                @if(str_contains($kondisi, 'baik'))
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                        <i class="bi bi-check-lg me-1"></i>{{ $pengembalian->kondisi_barang ?? 'Baik' }}
                                    </span>
                                @elseif(str_contains($kondisi, 'rusak'))
                                    <span class="badge bg-warning-subtle text-warning border border-warning border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                        <i class="bi bi-tools me-1"></i>{{ $pengembalian->kondisi_barang }}
                                    </span>
                                @else
                                    <span class="badge bg-body text-body border fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                        {{ $pengembalian->kondisi_barang ?? 'Baik' }}
                                    </span>
                                @endif
                            </td>

                            <!-- Catatan -->
                            <td class="px-3">
                                <span class="text-body-secondary fs-7 text-truncate d-inline-block" style="max-width: 180px;" title="{{ $pengembalian->catatan }}">
                                    {{ $pengembalian->catatan ?? '-' }}
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-1.5">
                                    <a href="{{ route('pengembalian.edit', ['id_pengembalian' => $pengembalian->id_pengembalian]) }}" class="btn btn-sm btn-outline-warning fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('pengembalian.delete', ['id_pengembalian' => $pengembalian->id_pengembalian]) }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7" onclick="return confirm('Apakah Anda yakin ingin menghapus data pengembalian ini?')" title="Hapus Data">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-body-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <div class="bg-body rounded-circle p-3 mb-1">
                                        <i class="bi bi-inbox text-body-secondary fs-2 opacity-50"></i>
                                    </div>
                                    <h6 class="fw-bold mb-0 text-body">Belum Ada Data Pengembalian</h6>
                                    <span class="fs-7 text-body-secondary">Data pengembalian alat yang ditambahkan akan muncul di sini.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Bagian Pagination -->
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer bg-transparent py-3 border-top d-flex justify-content-end">
            {!! $datap->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection