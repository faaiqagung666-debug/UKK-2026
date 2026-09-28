@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Peminjaman Alat')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #2563eb;
        --brand-2: #7c3aed;
        --hero-bg-light: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.08), transparent 45%),
                         radial-gradient(circle at 80% 30%, rgba(124, 58, 237, 0.08), transparent 45%);
        --hero-bg-dark: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.18), transparent 45%),
                        radial-gradient(circle at 80% 30%, rgba(124, 58, 237, 0.18), transparent 45%);
    }

    .hero-wrap {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        padding: 2.5rem 1.5rem;
        background: var(--hero-bg-light);
        border: 1px solid rgba(127, 127, 127, 0.12);
        transition: background 0.3s ease;
    }

    .badge-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        color: #fff !important;
        font-weight: 600;
        letter-spacing: .03em;
        box-shadow: 0 4px 18px rgba(37, 99, 235, 0.25);
    }

    .text-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .btn-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: .8rem;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
        transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
    }
    .btn-brand:hover,
    .btn-brand:focus {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 26px rgba(37, 99, 235, 0.4);
        filter: brightness(1.05);
    }

    .card-brand {
        border: 1px solid rgba(127, 127, 127, 0.12);
        border-radius: 1.2rem;
        background: var(--bs-body-bg);
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    /* Support Dark Mode Otomatis */
    [data-bs-theme="dark"] .hero-wrap {
        background: var(--hero-bg-dark);
        border-color: rgba(255, 255, 255, 0.08);
    }
</style>

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

    {{-- Hero Section --}}
    <section class="text-center hero-wrap mb-4 shadow-sm">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
            <i class="bi bi-box-seam me-1"></i> Transaksi Peminjaman
        </span>

        <h1 class="display-6 fw-bold mb-2 text-body">
            Daftar <span class="text-brand">Peminjaman Alat</span>
        </h1>

        <p class="text-body-secondary mx-auto mb-4" style="max-width: 560px;">
            Kelola riwayat permohonan, status persetujuan, dan jadwal peminjaman alat sarpras dengan mudah.
        </p>

        <a href="{{ route('peminjaman.create') }}" class="btn btn-brand px-4 py-2.5 d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Tambah Peminjaman Baru</span>
        </a>
    </section>

    {{-- Card Pembungkus Tabel --}}
    <div class="card card-brand shadow-sm overflow-hidden mb-4">
        
        {{-- Header Card --}}
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-list-check text-primary fs-5"></i>
                <h6 class="fw-bold mb-0 text-body">Data Peminjaman Aktif</h6>
            </div>
            <span class="badge bg-body-tertiary text-body-secondary border px-3 py-1.5 rounded-pill small fw-normal">
                Total: {{ count($datap) }} Data
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Peminjam</th>
                            <th class="py-3 px-3">Nama Alat</th>
                            <th class="py-3 px-3">Jumlah</th>
                            <th class="py-3 px-3">Tgl Pinjam</th>
                            <th class="py-3 px-3">Tgl Kembali</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3">Denda</th>
                            <th class="py-3 px-4 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @php $no = 1; @endphp
                        @forelse ($datap as $peminjaman)
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                            
                            <!-- Peminjam -->
                            <td class="px-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <span class="fw-bold text-body fs-7">
                                        {{ $peminjaman->user->nama ?? 'User ID: ' . $peminjaman->id_user }}
                                    </span>
                                </div>
                            </td>

                            <!-- Nama Alat -->
                            <td class="px-3">
                                <span class="fw-semibold text-body fs-7">
                                    {{ $peminjaman->alat->nama_alat ?? 'Alat ID: ' . $peminjaman->id_alat }}
                                </span>
                            </td>

                            <!-- Jumlah Unit -->
                            <td class="px-3">
                                <span class="badge bg-body-tertiary text-body border fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                    {{ $peminjaman->jumlah }} Unit
                                </span>
                            </td>

                            <!-- Tgl Pinjam -->
                            <td class="px-3">
                                <span class="text-body-secondary fs-7">
                                    <i class="bi bi-calendar-event me-1"></i>{{ $peminjaman->tanggal_pinjam }}
                                </span>
                            </td>

                            <!-- Tgl Kembali -->
                            <td class="px-3">
                                <span class="text-body-secondary fs-7">
                                    @if($peminjaman->tanggal_kembali)
                                        <i class="bi bi-calendar-check me-1"></i>{{ $peminjaman->tanggal_kembali }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </td>

                            <!-- Status Peminjaman -->
                            <td class="px-3">
                                @if($peminjaman->status == 'Pending')
                                    <span class="badge bg-warning-subtle text-warning border border-warning border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-hourglass-split me-1"></i>Pending
                                    </span>
                                @elseif($peminjaman->status == 'Disetujui')
                                    <span class="badge bg-info-subtle text-info border border-info border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-check2-circle me-1"></i>Disetujui
                                    </span>
                                @elseif($peminjaman->status == 'Ditolak')
                                    <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-x-circle me-1"></i>Ditolak
                                    </span>
                                @elseif($peminjaman->status == 'Dipinjam')
                                    <span class="badge bg-primary-subtle text-primary border border-primary border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-box-arrow-up-right me-1"></i>Dipinjam
                                    </span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-check-circle-fill me-1"></i>Dikembalikan
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

                            <!-- Aksi -->
                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-1.5">
                                    <a href="{{ route('peminjaman.edit', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}" class="btn btn-sm btn-outline-warning fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7" title="Edit Peminjaman">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('peminjaman.delete', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7" onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')" title="Hapus Data">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
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
                                    <span class="fs-7 text-body-secondary">Data peminjaman alat yang diajukan akan muncul di sini.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Bagian Pagination --}}
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer bg-transparent py-3 border-top d-flex justify-content-end">
            {!! $datap->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection