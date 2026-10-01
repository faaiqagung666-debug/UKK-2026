@extends('layouts.app')

@section('title', config('app.name') . ' -- Persetujuan Peminjaman')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container-fluid py-4 px-4">
    
    {{-- Alert Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                <div class="small fw-medium">{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Card Pembungkus Tabel --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        
        {{-- Header Card --}}
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check2-square text-primary fs-5"></i>
                <h6 class="fw-bold mb-0 text-body">Verifikasi & Daftar Peminjaman Alat</h6>
            </div>
            <span class="badge bg-body-tertiary text-body-secondary border px-3 py-1.5 rounded-pill small fw-normal">
                Total: {{ count($datap) }} Data
            </span>
        </div>

        {{-- Body Tabel --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Peminjam</th>
                            <th class="py-3 px-3">Nama Alat</th>
                            <th class="py-3 px-3">Jumlah</th>
                            <th class="py-3 px-3">Tgl Pinjam</th>
                            <th class="py-3 px-3">Tgl Kembali</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3">Denda</th>
                            <th class="py-3 px-4 text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($datap as $peminjaman)
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                            
                            <!-- Peminjam -->
                            <td class="px-3">
                                <span class="fw-bold text-body fs-7">
                                    {{ $peminjaman->user->nama ?? 'User ID: ' . $peminjaman->id_user }}
                                </span>
                            </td>

                            <!-- Nama Alat -->
                            <td class="px-3">
                                <span class="fw-semibold text-body fs-7">
                                    {{ $peminjaman->alat->nama_alat ?? 'Alat ID: ' . $peminjaman->id_alat }}
                                </span>
                            </td>

                            <!-- Jumlah -->
                            <td class="px-3">
                                <span class="badge bg-body-tertiary text-body border fw-semibold px-2 py-1 fs-8">
                                    {{ $peminjaman->jumlah }} Unit
                                </span>
                            </td>

                            <!-- Tgl Pinjam -->
                            <td class="px-3 text-body-secondary fs-7">
                                {{ $peminjaman->tanggal_pinjam }}
                            </td>

                            <!-- Tgl Kembali -->
                            <td class="px-3 text-body-secondary fs-7">
                                {{ $peminjaman->tanggal_kembali ?? '-' }}
                            </td>

                            <!-- Status -->
                            <td class="px-3">
                                @if($peminjaman->status == 'Pending')
                                    <span class="badge bg-warning-subtle text-warning border border-warning border-opacity-25 px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-hourglass-split me-1"></i>Pending
                                    </span>
                                @elseif($peminjaman->status == 'Disetujui')
                                    <span class="badge bg-info-subtle text-info border border-info border-opacity-25 px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-check2-circle me-1"></i>Disetujui
                                    </span>
                                @elseif($peminjaman->status == 'Ditolak')
                                    <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-x-circle me-1"></i>Ditolak
                                    </span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-check-circle-fill me-1"></i>{{ $peminjaman->status }}
                                    </span>
                                @endif
                            </td>

                            <!-- Denda -->
                            <td class="px-3">
                                @if(($peminjaman->denda ?? 0) > 0)
                                    <span class="text-danger fw-bold fs-7">Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-body-secondary fs-7">Rp 0</span>
                                @endif
                            </td>

                            <!-- Aksi (Khusus Petugas: Tombol Proses / Verifikasi) -->
                            <td class="px-4 text-center">
                                <a href="{{ route('petugas.peminjaman.edit', $peminjaman->id_peminjaman ?? $peminjaman->id) }}" class="btn btn-sm btn-outline-primary fw-medium px-3 py-1 rounded-2 fs-7 d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-pencil-square"></i> Proses
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-body-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <div class="bg-body-tertiary rounded-circle p-3 mb-1">
                                        <i class="bi bi-inbox text-body-secondary fs-2 opacity-50"></i>
                                    </div>
                                    <h6 class="fw-bold mb-0 text-body">Belum Ada Data Peminjaman</h6>
                                    <span class="fs-7 text-body-secondary">Permohonan peminjaman dari siswa akan muncul di sini.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection