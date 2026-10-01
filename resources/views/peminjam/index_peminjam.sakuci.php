@extends('layouts.app')

@section('title', config('app.name') . ' -- Riwayat Pengajuan Peminjaman')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,600;12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-soft: rgba(13, 122, 80, 0.10);
        --brand-border: rgba(13, 122, 80, 0.18);
        --hero-bg-light:
            radial-gradient(circle at 20% 20%, rgba(13, 122, 80, 0.08), transparent 45%),
            radial-gradient(circle at 80% 30%, rgba(217, 242, 75, 0.08), transparent 45%);
        --hero-bg-dark:
            radial-gradient(circle at 20% 20%, rgba(13, 122, 80, 0.18), transparent 45%),
            radial-gradient(circle at 80% 30%, rgba(217, 242, 75, 0.10), transparent 45%);
    }

    .riwayat-peminjaman-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .riwayat-peminjaman-page h1,
    .riwayat-peminjaman-page h2,
    .riwayat-peminjaman-page h3,
    .riwayat-peminjaman-page h4,
    .riwayat-peminjaman-page h5,
    .riwayat-peminjaman-page h6 {
        font-family: 'Bricolage Grotesque', sans-serif;
    }

    .hero-wrap {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        padding: 2.5rem 1.5rem;
        background: var(--hero-bg-light);
        border: 1px solid var(--brand-border);
        transition: background 0.3s ease;
        box-shadow: 0 10px 30px rgba(13, 122, 80, 0.08);
        animation: heroIn .6s ease both;
    }

    .hero-wrap::before,
    .hero-wrap::after {
        content: "";
        position: absolute;
        pointer-events: none;
        border: 2px solid rgba(13, 122, 80, 0.10);
        border-radius: 50%;
    }

    .hero-wrap::before {
        width: 330px;
        height: 330px;
        right: -150px;
        top: -185px;
    }

    .hero-wrap::after {
        width: 250px;
        height: 250px;
        left: -130px;
        bottom: -170px;
    }

    .hero-wrap > * {
        position: relative;
        z-index: 2;
    }

    .badge-brand {
        background: var(--whistle);
        color: var(--brand-2) !important;
        font-weight: 800;
        letter-spacing: .03em;
        box-shadow: 0 4px 18px rgba(13, 122, 80, 0.18);
        animation: badgePulse 2.8s ease-in-out infinite;
    }

    .text-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .card-brand {
        border: 1px solid var(--brand-border);
        border-radius: 1.2rem;
        background: var(--bs-body-bg);
        transition: background 0.3s ease, border-color 0.3s ease,
                    box-shadow 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.035);
        overflow: hidden;
        animation: fadeUp .55s ease both;
    }

    .card-brand:hover {
        border-color: rgba(13, 122, 80, 0.28);
        box-shadow: 0 10px 28px rgba(13, 122, 80, 0.08);
    }

    .card-brand .card-header {
        border-bottom-color: var(--brand-border) !important;
    }

    .card-brand .card-header .text-primary {
        color: var(--brand-1) !important;
    }

    .card-brand table thead {
        background: rgba(13, 122, 80, 0.045) !important;
    }

    .card-brand table tbody tr {
        transition: background .2s ease;
    }

    .card-brand table tbody tr:hover {
        background: rgba(13, 122, 80, 0.045);
    }

    .card-brand table tbody tr td:first-child {
        position: relative;
    }

    .card-brand table tbody tr:hover td:first-child::before {
        content: "";
        position: absolute;
        left: 0;
        top: 10%;
        bottom: 10%;
        width: 3px;
        border-radius: 0 4px 4px 0;
        background: var(--brand-1);
    }

    .card-brand .btn-success {
        background: var(--brand-1) !important;
        border-color: var(--brand-1) !important;
    }

    .card-brand .btn-success:hover {
        background: var(--brand-2) !important;
        border-color: var(--brand-2) !important;
        transform: translateY(-1px);
    }

    .card-brand .form-select:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem rgba(13, 122, 80, 0.12);
    }

    [data-bs-theme="dark"] .hero-wrap {
        background: var(--hero-bg-dark);
        border-color: rgba(255, 255, 255, 0.08);
    }

    [data-bs-theme="dark"] .card-brand {
        border-color: rgba(255, 255, 255, 0.08);
        background: rgba(255, 255, 255, 0.02);
    }

    [data-bs-theme="dark"] .card-brand:hover {
        border-color: rgba(217, 242, 75, 0.20);
    }

    @keyframes heroIn {
        from {
            opacity: 0;
            transform: translateY(-12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes badgePulse {
        0%, 100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.03);
        }
    }

    @media (max-width: 768px) {
        .hero-wrap {
            border-radius: 1.25rem;
            padding: 2rem 1rem;
        }

        .hero-wrap h1 {
            font-size: 1.7rem;
        }

        .card-brand {
            border-radius: 1rem;
        }
    }
</style>

<div class="container-fluid py-4 px-4 riwayat-peminjaman-page">

```
{{-- Alert Notifikasi Sukses --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
            <div class="small fw-medium">{{ session('success') }}</div>
        </div>

        <button type="button"
                class="btn-close shadow-none"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

{{-- Hero Section --}}
<section class="text-center hero-wrap mb-4 shadow-sm">

    <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
        <i class="bi bi-clock-history me-1"></i>
        Riwayat Pengguna
    </span>

    <h1 class="display-6 fw-bold mb-2 text-body">
        Riwayat <span class="text-brand">Peminjaman Alat</span>
    </h1>

    <p class="text-body-secondary mx-auto mb-0" style="max-width: 560px;">
        Daftar pengajuan peminjaman alat yang telah Anda kirimkan
        beserta status dan opsi pengembalian barang.
    </p>

</section>

{{-- Card Pembungkus Tabel --}}
<div class="card card-brand shadow-sm overflow-hidden mb-4">

    {{-- Header Card --}}
    <div class="card-header bg-transparent border-bottom py-3 px-4
                d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-journal-text text-primary fs-5"></i>

            <h6 class="fw-bold mb-0 text-body">
                Daftar Pengajuan Anda
            </h6>
        </div>

        @if(method_exists($datap, 'total'))
            <span class="badge bg-body-tertiary text-body-secondary border
                         px-3 py-1.5 rounded-pill small fw-normal">
                Total: {{ $datap->total() }} Data
            </span>
        @endif

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="bg-body-tertiary border-bottom
                              text-body-secondary text-uppercase
                              fs-8 tracking-wider">

                    <tr>
                        <th class="py-3 px-4 text-center" style="width: 5%;">
                            No
                        </th>

                        <th class="py-3 px-3">
                            Nama Alat
                        </th>

                        <th class="py-3 px-3">
                            Jumlah
                        </th>

                        <th class="py-3 px-3">
                            Tgl Pinjam
                        </th>

                        <th class="py-3 px-3">
                            Tgl Kembali
                        </th>

                        <th class="py-3 px-3">
                            Status
                        </th>

                        <th class="py-3 px-3">
                            Denda
                        </th>

                        <th class="py-3 px-3 text-center">
                            Aksi Pengembalian
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y">

                    @php
                        $no = 1;
                    @endphp

                    @forelse ($datap as $peminjaman)

                        <tr>

                            {{-- No --}}
                            <td class="px-4 text-center text-body-secondary
                                       fw-medium fs-7">
                                {{ $no++ }}
                            </td>

                            {{-- Nama Alat --}}
                            <td class="px-3">
                                <div class="fw-semibold text-body fs-7">
                                    <i class="bi bi-box-seam text-body-secondary me-1"></i>

                                    {{ $peminjaman->alat->nama_alat
                                        ?? $peminjaman->alat->nama
                                        ?? 'Alat ID: ' . $peminjaman->id_alat }}
                                </div>
                            </td>

                            {{-- Jumlah --}}
                            <td class="px-3">
                                <span class="badge bg-body-tertiary text-body border
                                             fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                    {{ $peminjaman->jumlah }} Unit
                                </span>
                            </td>

                            {{-- Tanggal Pinjam --}}
                            <td class="px-3">
                                <span class="text-body-secondary fs-7">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ $peminjaman->tanggal_pinjam }}
                                </span>
                            </td>

                            {{-- Tanggal Kembali --}}
                            <td class="px-3">
                                <span class="text-body-secondary fs-7">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    {{ $peminjaman->tanggal_kembali ?? '-' }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-3">

                                @if($peminjaman->status == 'Pending')

                                    <span class="badge bg-warning-subtle text-warning
                                                 border border-warning border-opacity-25
                                                 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-hourglass-split me-1"></i>
                                        Pending
                                    </span>

                                @elseif($peminjaman->status == 'Disetujui')

                                    <span class="badge bg-info-subtle text-info
                                                 border border-info border-opacity-25
                                                 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Disetujui
                                    </span>

                                @elseif($peminjaman->status == 'Ditolak')

                                    <span class="badge bg-danger-subtle text-danger
                                                 border border-danger border-opacity-25
                                                 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Ditolak
                                    </span>

                                @elseif($peminjaman->status == 'Dipinjam')

                                    <span class="badge bg-primary-subtle text-primary
                                                 border border-primary border-opacity-25
                                                 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-box-arrow-in-right me-1"></i>
                                        Dipinjam
                                    </span>

                                @else

                                    <span class="badge bg-success-subtle text-success
                                                 border border-success border-opacity-25
                                                 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-check-all me-1"></i>
                                        Dikembalikan
                                    </span>

                                @endif

                            </td>

                            {{-- Denda --}}
                            <td class="px-3">

                                @php
                                    $dendaFinal = $peminjaman->denda ?? 0;

                                    $dataPengembalian =
                                        \App\Models\Pengembalian::where(
                                            'id_peminjaman',
                                            $peminjaman->id_peminjaman
                                        )->first();

                                    if ($dataPengembalian) {
                                        $dendaFinal = $dataPengembalian->denda;
                                    }
                                @endphp

                                @if($dendaFinal > 0)

                                    <span class="text-danger fw-bold fs-7">
                                        Rp {{ number_format($dendaFinal, 0, ',', '.') }}
                                    </span>

                                @else

                                    <span class="text-body-secondary fs-7">
                                        -
                                    </span>

                                @endif

                            </td>

                            {{-- Aksi Pengembalian --}}
                            <td class="px-3 text-center">

                                @if(
                                    $peminjaman->status == 'Disetujui' ||
                                    $peminjaman->status == 'Dipinjam'
                                )

                                    {{-- ROUTE SUDAH DIPERBAIKI --}}
                                    <form
                                        action="{{ route('peminjam.pengembalian.store', ['id' => $peminjaman->id_peminjaman]) }}"
                                        method="POST"
                                        class="d-inline-block text-start p-2.5
                                               border rounded-3 bg-body-tertiary
                                               shadow-sm"
                                        style="min-width: 170px;"
                                    >

                                        @csrf

                                        <div class="mb-2">

                                            <label class="form-label fs-9 mb-1
                                                          fw-bold text-body-secondary
                                                          uppercase">
                                                Kondisi Barang:
                                            </label>

                                            <select
                                                name="kondisi_barang"
                                                class="form-select form-select-sm fs-8 shadow-none"
                                            >
                                                <option value="Baik">
                                                    Baik
                                                </option>

                                                <option value="Rusak Ringan">
                                                    Rusak Ringan
                                                </option>

                                                <option value="Rusak Berat">
                                                    Rusak Berat
                                                </option>
                                            </select>

                                        </div>

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-success w-100
                                                   fs-8 py-1.5 fw-semibold
                                                   d-inline-flex align-items-center
                                                   justify-content-center gap-1 shadow-sm"
                                        >
                                            <i class="bi bi-arrow-return-left"></i>
                                            Kembalikan
                                        </button>

                                    </form>

                                @else

                                    <span class="text-body-secondary fs-7">
                                        -
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-5 text-body-secondary">

                                <div class="d-flex flex-column
                                            align-items-center gap-2">

                                    <div class="bg-body-tertiary
                                                rounded-circle p-3 mb-1">

                                        <i class="bi bi-inbox
                                                  text-body-secondary
                                                  fs-2 opacity-50"></i>

                                    </div>

                                    <h6 class="fw-bold mb-0 text-body">
                                        Belum Ada Riwayat Peminjaman
                                    </h6>

                                    <span class="fs-7 text-body-secondary">
                                        Pengajuan peminjaman alat yang Anda buat
                                        akan muncul di sini.
                                    </span>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Pagination --}}
    @if(method_exists($datap, 'hasPages') && $datap->hasPages())

        <div class="card-footer bg-transparent py-3 border-top
                    d-flex justify-content-end">

            {!! $datap->links() !!}

        </div>

    @endif

</div>
```

</div>
@endsection
