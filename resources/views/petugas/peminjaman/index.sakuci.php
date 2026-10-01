@extends('layouts.app')

@section('title', config('app.name') . ' -- Kelola Peminjaman Alat')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.22);

        --hero-bg-light:
            radial-gradient(circle at 20% 20%, rgba(13, 122, 80, 0.08), transparent 45%),
            radial-gradient(circle at 80% 30%, rgba(217, 242, 75, 0.12), transparent 45%);

        --hero-bg-dark:
            radial-gradient(circle at 20% 20%, rgba(13, 122, 80, 0.20), transparent 45%),
            radial-gradient(circle at 80% 30%, rgba(217, 242, 75, 0.08), transparent 45%);
    }

    .hero-wrap {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        padding: 2.5rem 1.5rem;
        background: var(--hero-bg-light);
        border: 1px solid rgba(13, 122, 80, 0.12);
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    .badge-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        color: #fff !important;
        font-weight: 600;
        letter-spacing: .03em;
        box-shadow: 0 4px 18px var(--brand-glow);
    }

    .text-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .btn-brand-outline {
        border: 2px solid var(--brand-1);
        color: var(--brand-1);
        font-weight: 600;
        border-radius: .8rem;
        background: transparent;
        transition: all .18s ease;
    }

    .btn-brand-outline:hover,
    .btn-brand-outline:focus {
        background: var(--brand-1);
        color: #fff;
        border-color: var(--brand-1);
        box-shadow: 0 6px 20px var(--brand-glow);
        transform: translateY(-1px);
    }

    .card-brand {
        border: 1px solid rgba(13, 122, 80, 0.12);
        border-radius: 1.2rem;
        background: var(--bs-body-bg);
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    .card-brand .card-header {
        border-bottom-color: rgba(13, 122, 80, 0.12) !important;
    }

    .card-brand .card-header i {
        color: var(--brand-1) !important;
    }

    .table {
        --bs-table-hover-bg: rgba(13, 122, 80, 0.045);
    }

    .table thead th {
        white-space: nowrap;
    }

    .table tbody tr {
        transition: background-color .18s ease, box-shadow .18s ease;
    }

    .table tbody tr:hover {
        box-shadow: inset 4px 0 0 var(--brand-1);
    }

    .badge-id {
        background: rgba(13, 122, 80, 0.07);
        color: var(--brand-1);
        border-color: rgba(13, 122, 80, 0.18) !important;
    }

    .btn-success {
        background: var(--brand-1);
        border-color: var(--brand-1);
    }

    .btn-success:hover,
    .btn-success:focus {
        background: var(--brand-2);
        border-color: var(--brand-2);
    }

    .alert-success {
        background: rgba(13, 122, 80, 0.08);
        color: var(--brand-2);
    }

    [data-bs-theme="dark"] .hero-wrap {
        background: var(--hero-bg-dark);
        border-color: rgba(255, 255, 255, 0.08);
    }

    [data-bs-theme="dark"] .card-brand {
        border-color: rgba(255, 255, 255, 0.08);
    }

    [data-bs-theme="dark"] .card-brand .card-header {
        border-bottom-color: rgba(255, 255, 255, 0.08) !important;
    }

    [data-bs-theme="dark"] .badge-id {
        background: rgba(217, 242, 75, 0.08);
        color: var(--whistle);
        border-color: rgba(217, 242, 75, 0.18) !important;
    }

    [data-bs-theme="dark"] .alert-success {
        background: rgba(13, 122, 80, 0.18);
        color: #a7f3d0;
    }

    [data-bs-theme="dark"] .table {
        --bs-table-hover-bg: rgba(13, 122, 80, 0.10);
    }

    @media (max-width: 768px) {
        .hero-wrap {
            padding: 2rem 1rem;
        }

        .hero-wrap .btn-brand-outline {
            width: 100%;
            justify-content: center;
        }

        .card-brand .card-header {
            gap: 1rem;
            flex-wrap: wrap;
        }
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
            <i class="bi bi-shield-check me-1"></i> Panel Petugas
        </span>

        <h1 class="display-6 fw-bold mb-2 text-body">
            Kelola <span class="text-brand">Peminjaman Alat</span>
        </h1>

        <p class="text-body-secondary mx-auto mb-4" style="max-width: 560px;">
            Setujui atau tolak permohonan peminjaman alat dari peminjam, serta cetak laporan berkala dengan mudah.
        </p>

        <a href="{{ route('petugas.peminjaman.cetak') }}"
           target="_blank"
           class="btn btn-brand-outline px-4 py-2.5 d-inline-flex align-items-center gap-2">
            <i class="bi bi-printer fs-6"></i>
            <span>Cetak Laporan Peminjaman</span>
        </a>
    </section>

    {{-- Card Pembungkus Tabel --}}
    <div class="card card-brand shadow-sm overflow-hidden mb-4">
        
        {{-- Header Card --}}
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-list-check text-primary fs-5"></i>
                <h6 class="fw-bold mb-0 text-body">Daftar Permohonan Peminjaman</h6>
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
                            <th class="py-3 px-3">ID User</th>
                            <th class="py-3 px-3">ID Alat</th>
                            <th class="py-3 px-3">Jumlah</th>
                            <th class="py-3 px-3">Tgl Pinjam</th>
                            <th class="py-3 px-3">Tgl Kembali</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-4 text-center" style="width: 180px;">Aksi Petugas</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($datap as $index => $p)
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">
                                {{ $index + 1 }}
                            </td>
                            
                            <!-- ID User -->
                            <td class="px-3">
                                <span class="badge badge-id fw-bold px-2.5 py-1.5 rounded-2 fs-8">
                                    #{{ $p->id_user }}
                                </span>
                            </td>

                            <!-- ID Alat -->
                            <td class="px-3">
                                <span class="badge badge-id fw-bold px-2.5 py-1.5 rounded-2 fs-8">
                                    #{{ $p->id_alat }}
                                </span>
                            </td>

                            <!-- Jumlah -->
                            <td class="px-3">
                                <span class="text-body fw-semibold fs-7">
                                    {{ $p->jumlah }} Unit
                                </span>
                            </td>

                            <!-- Tanggal Pinjam -->
                            <td class="px-3">
                                <span class="text-body fs-7">
                                    <i class="bi bi-calendar-event text-body-secondary me-1"></i>
                                    {{ $p->tanggal_pinjam }}
                                </span>
                            </td>

                            <!-- Tanggal Kembali -->
                            <td class="px-3">
                                <span class="text-body fs-7">
                                    <i class="bi bi-calendar-check text-body-secondary me-1"></i>
                                    {{ $p->tanggal_kembali }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-3">
                                @if($p->status == 'Pending')
                                    <span class="badge bg-warning-subtle text-warning border border-warning border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-clock-history me-1"></i>Pending
                                    </span>

                                @elseif($p->status == 'Disetujui')
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-check-circle-fill me-1"></i>Disetujui
                                    </span>

                                @elseif($p->status == 'Ditolak')
                                    <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-x-circle-fill me-1"></i>Ditolak
                                    </span>

                                @else
                                    <span class="badge bg-info-subtle text-info border border-info border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        {{ $p->status }}
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi Petugas -->
                            <td class="px-4 text-center">
                                @if($p->status == 'Pending')
                                    <div class="d-inline-flex align-items-center justify-content-center gap-1.5">

                                        <!-- Tombol Setujui -->
                                        <form action="{{ route('petugas.peminjaman.status', ['id' => $p->id_peminjaman]) }}"
                                              method="POST"
                                              class="d-inline m-0">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="status" value="Disetujui">

                                            <button type="submit"
                                                    class="btn btn-sm btn-success fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                                    title="Setujui Peminjaman">
                                                <i class="bi bi-check-lg"></i>
                                                Setujui
                                            </button>
                                        </form>
                                        
                                        <!-- Tombol Tolak -->
                                        <form action="{{ route('petugas.peminjaman.status', ['id' => $p->id_peminjaman]) }}"
                                              method="POST"
                                              class="d-inline m-0">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="status" value="Ditolak">

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                                    onclick="return confirm('Apakah Anda yakin ingin menolak peminjaman ini?')"
                                                    title="Tolak Peminjaman">
                                                <i class="bi bi-x-lg"></i>
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="badge bg-body-tertiary text-body-secondary border px-2.5 py-1 rounded-2 fs-8 fw-normal">
                                        Selesai ({{ $p->status }})
                                    </span>
                                @endif
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-body-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <div class="bg-body-tertiary rounded-circle p-3 mb-1">
                                        <i class="bi bi-folder2-open text-body-secondary fs-2 opacity-50"></i>
                                    </div>

                                    <h6 class="fw-bold mb-0 text-body">
                                        Belum Ada Data Peminjaman
                                    </h6>

                                    <span class="fs-7 text-body-secondary">
                                        Permohonan peminjaman alat yang masuk akan muncul di sini.
                                    </span>
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