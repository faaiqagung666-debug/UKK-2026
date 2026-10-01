@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Peminjaman Alat')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">

<style>
    /* ============ Token warna & tipografi ============ */
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --font-display: 'Bricolage Grotesque', 'Plus Jakarta Sans', system-ui, sans-serif;
        --font-body: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
    }

    .container-fluid {
        font-family: var(--font-body);
    }

    /* Kelas utilitas di markup yang tidak ada di Bootstrap */
    .container-fluid .fs-7 {
        font-size: 0.88rem !important;
    }

    .container-fluid .fs-8 {
        font-size: 0.75rem !important;
    }

    .container-fluid .tracking-wider {
        letter-spacing: 0.06em;
    }

    .container-fluid .py-2\.5 {
        padding-top: 0.7rem !important;
        padding-bottom: 0.7rem !important;
    }

    .container-fluid .py-1\.5 {
        padding-top: 0.4rem !important;
        padding-bottom: 0.4rem !important;
    }

    .container-fluid .px-2\.5 {
        padding-left: 0.65rem !important;
        padding-right: 0.65rem !important;
    }

    .container-fluid .gap-1\.5 {
        gap: 0.4rem !important;
    }

    /* ============ Hero ============ */
    .hero-wrap {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        isolation: isolate;
        padding: 2.75rem 1.5rem;
        background:
            radial-gradient(
                60% 90% at 100% 0%,
                rgba(217, 242, 75, 0.16) 0%,
                rgba(217, 242, 75, 0) 60%
            ),
            linear-gradient(
                145deg,
                #0d7a50 0%,
                #075c3f 42%,
                #08211b 100%
            );
        border: 1px solid rgba(255, 255, 255, 0.14);
        box-shadow: 0 24px 48px -22px rgba(6, 78, 59, 0.55) !important;
        transition: border-color 0.3s ease;
    }

    /* Garis lapangan di latar */
    .hero-wrap::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        opacity: 0.11;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 400' fill='none' stroke='%23ffffff' stroke-width='2'%3E%3Crect x='20' y='20' width='560' height='360'/%3E%3Cpath d='M300 20v360'/%3E%3Ccircle cx='300' cy='200' r='62'/%3E%3Crect x='20' y='120' width='92' height='160'/%3E%3Crect x='488' y='120' width='92' height='160'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: 760px auto;
        background-position: center 40%;
    }

    /*
    | Judul hero dibuat eksplisit putih supaya tidak mengikuti
    | warna text-body Bootstrap yang bisa berubah saat dark mode.
    */
    .hero-wrap h1 {
        font-family: var(--font-display);
        font-weight: 800 !important;
        letter-spacing: -0.025em;
        color: #ffffff !important;
        text-wrap: balance;
    }

    /*
    | Bagian "Peminjaman Alat" dibuat lime agar sangat kontras
    | dengan background hijau hero.
    */
    .hero-wrap h1 .text-brand {
        color: var(--whistle) !important;
        -webkit-text-fill-color: var(--whistle);
        background: none !important;
        -webkit-background-clip: border-box;
        background-clip: border-box;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.18);
    }

    .hero-wrap p {
        color: rgba(255, 255, 255, 0.9) !important;
        line-height: 1.7;
    }

    /*
    | Badge Transaksi Peminjaman
    */
    .badge-brand {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--whistle) !important;
        color: #052e24 !important;
        font-weight: 800;
        letter-spacing: .03em;
        border: 1px solid rgba(255, 255, 255, 0.35);
        box-shadow:
            0 4px 18px rgba(217, 242, 75, 0.3),
            0 0 0 1px rgba(217, 242, 75, 0.08);
    }

    .badge-brand i {
        color: #064e3b !important;
    }

    .text-brand {
        background: none;
        -webkit-background-clip: border-box;
        background-clip: border-box;
        color: var(--whistle) !important;
    }

    /*
    | Tombol Tambah
    */
    .btn-brand {
        position: relative;
        overflow: hidden;
        background: #ffffff;
        border: 2px solid #ffffff;
        color: var(--brand-2);
        font-weight: 700;
        border-radius: 999px;
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.25);
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            background-color .2s ease,
            border-color .2s ease;
    }

    .btn-brand:hover,
    .btn-brand:focus {
        color: #0a2a22;
        background: var(--whistle);
        border-color: var(--whistle);
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.3);
    }

    .btn-brand:focus-visible {
        outline: 3px solid var(--whistle);
        outline-offset: 3px;
    }

    .btn-brand i {
        transition: transform .25s ease;
    }

    .btn-brand:hover i {
        transform: rotate(90deg) scale(1.1);
    }

    /* ============ Kartu & tabel ============ */

    .card-brand {
        border: 1px solid var(--bs-border-color-translucent);
        border-radius: 1.2rem;
        background: var(--bs-body-bg);
        box-shadow:
            0 1px 2px rgba(0, 0, 0, 0.04),
            0 14px 30px -20px rgba(6, 78, 59, 0.25) !important;
        transition:
            background 0.3s ease,
            border-color 0.3s ease;
    }

    .card-brand .card-header h6 {
        font-family: var(--font-display);
        font-weight: 800 !important;
        letter-spacing: -0.01em;
        font-size: 1.05rem;
    }

    .card-brand .card-header .bi-list-check {
        color: var(--brand-1) !important;
    }

    .container-fluid .table {
        --bs-table-hover-bg: rgba(13, 122, 80, 0.06);
    }

    .container-fluid .table thead th {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        white-space: nowrap;
    }

    .container-fluid .table tbody tr {
        transition: background-color 0.2s ease;
    }

    .container-fluid .table tbody tr > td:first-child {
        position: relative;
    }

    .container-fluid .table tbody tr > td:first-child::before {
        content: "";
        position: absolute;
        left: 0;
        top: 15%;
        bottom: 15%;
        width: 3px;
        border-radius: 0 3px 3px 0;
        background: var(--brand-1);
        transform: scaleY(0);
        transition: transform 0.25s ease;
    }

    .container-fluid .table tbody tr:hover > td:first-child::before {
        transform: scaleY(1);
    }

    /* Tombol aksi */

    .container-fluid td .btn {
        transition:
            transform 0.18s ease,
            box-shadow 0.18s ease,
            background-color 0.18s ease,
            color 0.18s ease;
    }

    .container-fluid td .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px -6px rgba(0, 0, 0, 0.35);
    }

    .container-fluid td .btn i {
        transition: transform 0.2s ease;
    }

    .container-fluid td .btn:hover i {
        transform: scale(1.15) rotate(-6deg);
    }

    /* Paginasi */

    .container-fluid .pagination {
        --bs-pagination-color: var(--brand-1);
        --bs-pagination-hover-color: var(--brand-2);
        --bs-pagination-active-bg: var(--brand-1);
        --bs-pagination-active-border-color: var(--brand-1);
        --bs-pagination-focus-box-shadow:
            0 0 0 0.2rem rgba(13, 122, 80, 0.25);
    }

    /* ============ Animasi ============ */

    @keyframes heroIn {
        from {
            opacity: 0;
            transform: translateY(18px) scale(0.985);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-12px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    @keyframes badgePulse {
        0% {
            box-shadow: 0 0 0 0 rgba(217, 242, 75, 0.55);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(217, 242, 75, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(217, 242, 75, 0);
        }
    }

    @keyframes floatY {
        from {
            transform: translateY(0);
        }

        to {
            transform: translateY(-6px);
        }
    }

    @media (prefers-reduced-motion: no-preference) {

        .container-fluid .alert {
            animation:
                slideDown 0.5s cubic-bezier(0.2, 0.7, 0.2, 1) backwards;
        }

        .hero-wrap {
            animation:
                heroIn 0.7s cubic-bezier(0.2, 0.7, 0.2, 1) backwards;
        }

        .hero-wrap > * {
            animation:
                fadeUp 0.6s cubic-bezier(0.2, 0.7, 0.2, 1) backwards;
        }

        .hero-wrap > *:nth-child(1) {
            animation-delay: 0.15s;
        }

        .hero-wrap > *:nth-child(2) {
            animation-delay: 0.25s;
        }

        .hero-wrap > *:nth-child(3) {
            animation-delay: 0.35s;
        }

        .hero-wrap > *:nth-child(4) {
            animation-delay: 0.45s;
        }

        .hero-wrap > .badge-brand {
            animation:
                fadeUp 0.6s cubic-bezier(0.2, 0.7, 0.2, 1) 0.15s backwards,
                badgePulse 2.6s ease-out 1.2s infinite;
        }

        .card-brand {
            animation:
                fadeUp 0.6s cubic-bezier(0.2, 0.7, 0.2, 1) 0.4s backwards;
        }

        .container-fluid .table tbody tr {
            animation: fadeUp 0.45s ease backwards;
        }

        .container-fluid .table tbody tr:nth-child(1) {
            animation-delay: 0.55s;
        }

        .container-fluid .table tbody tr:nth-child(2) {
            animation-delay: 0.62s;
        }

        .container-fluid .table tbody tr:nth-child(3) {
            animation-delay: 0.69s;
        }

        .container-fluid .table tbody tr:nth-child(4) {
            animation-delay: 0.76s;
        }

        .container-fluid .table tbody tr:nth-child(5) {
            animation-delay: 0.83s;
        }

        .container-fluid .table tbody tr:nth-child(6) {
            animation-delay: 0.9s;
        }

        .container-fluid .table tbody tr:nth-child(7) {
            animation-delay: 0.97s;
        }

        .container-fluid .table tbody tr:nth-child(8) {
            animation-delay: 1.04s;
        }

        .container-fluid .bi-inbox {
            display: inline-block;
            animation: floatY 3s ease-in-out infinite alternate;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .btn-brand,
        .btn-brand i,
        .container-fluid td .btn,
        .container-fluid td .btn i {
            transition: none;
        }

        .btn-brand:hover,
        .container-fluid td .btn:hover {
            transform: none;
        }
    }

    @media (max-width: 576px) {

        .hero-wrap {
            padding: 2rem 1.1rem;
        }

        .hero-wrap::before {
            background-size: 520px auto;
            opacity: 0.09;
        }
    }

    /* ============ Mode gelap ============ */

    [data-bs-theme="dark"] .hero-wrap {
        background:
            radial-gradient(
                60% 90% at 100% 0%,
                rgba(217, 242, 75, 0.08) 0%,
                rgba(217, 242, 75, 0) 60%
            ),
            linear-gradient(
                145deg,
                #064e3b 0%,
                #0a2a22 55%,
                #020a08 100%
            );
        border-color: rgba(255, 255, 255, 0.08);
        box-shadow:
            0 24px 48px -22px rgba(0, 0, 0, 0.7) !important;
    }

    /*
    | Pastikan badge "Transaksi Peminjaman" tetap sangat jelas
    | pada dark mode.
    */
    [data-bs-theme="dark"] .badge-brand {
        background: #d9f24b !important;
        color: #03251c !important;
        border-color: rgba(217, 242, 75, 0.65);
        box-shadow:
            0 4px 18px rgba(217, 242, 75, 0.25),
            0 0 0 1px rgba(217, 242, 75, 0.08);
    }

    [data-bs-theme="dark"] .badge-brand i {
        color: #064e3b !important;
    }

    /*
    | Pastikan "Daftar" putih dan "Peminjaman Alat" lime
    | tetap kontras pada dark mode.
    */
    [data-bs-theme="dark"] .hero-wrap h1 {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .hero-wrap h1 .text-brand {
        color: #d9f24b !important;
        -webkit-text-fill-color: #d9f24b;
        text-shadow:
            0 1px 2px rgba(0, 0, 0, 0.45),
            0 0 14px rgba(217, 242, 75, 0.12);
    }

    [data-bs-theme="dark"] .hero-wrap p {
        color: rgba(255, 255, 255, 0.88) !important;
    }

    [data-bs-theme="dark"] .card-brand {
        border-color: rgba(255, 255, 255, 0.08);
    }

    [data-bs-theme="dark"] .container-fluid .table {
        --bs-table-hover-bg: rgba(217, 242, 75, 0.06);
    }

    [data-bs-theme="dark"] .container-fluid .table tbody tr > td:first-child::before {
        background: var(--whistle);
    }

    [data-bs-theme="dark"] .card-brand .card-header .bi-list-check {
        color: var(--whistle) !important;
    }

    [data-bs-theme="dark"] .container-fluid .pagination {
        --bs-pagination-color: var(--whistle);
        --bs-pagination-active-bg: var(--brand-1);
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

            <button
                type="button"
                class="btn-close shadow-none"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>
        </div>
    @endif

    {{-- Hero Section --}}
    <section class="text-center hero-wrap mb-4 shadow-sm">

        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
            <i class="bi bi-box-seam me-1"></i>
            Transaksi Peminjaman
        </span>

        <h1 class="display-6 fw-bold mb-2 text-body">
            Daftar <span class="text-brand">Peminjaman Alat Olahraga</span>
        </h1>

        <p class="text-body-secondary mx-auto mb-4" style="max-width: 560px;">
            Kelola riwayat permohonan, status persetujuan, dan jadwal peminjaman alat Olahraga dengan mudah.
        </p>

        <a
            href="{{ route('peminjaman.create') }}"
            class="btn btn-brand px-4 py-2.5 d-inline-flex align-items-center gap-2">
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
                <h6 class="fw-bold mb-0 text-body">
                    Data Peminjaman Aktif
                </h6>
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
                            <th class="py-3 px-4 text-center" style="width: 5%;">
                                No
                            </th>

                            <th class="py-3 px-3">
                                Peminjam
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

                            <th class="py-3 px-4 text-center" style="width: 180px;">
                                Aksi
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y">

                        @php $no = 1; @endphp

                        @forelse ($datap as $peminjaman)

                        <tr>

                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">
                                {{ $no++ }}
                            </td>

                            <!-- Peminjam -->
                            <td class="px-3">

                                <div class="d-flex align-items-center gap-2">

                                    <div
                                        class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                        style="width: 32px; height: 32px; font-size: 0.8rem;">
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
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ $peminjaman->tanggal_pinjam }}
                                </span>

                            </td>

                            <!-- Tgl Kembali -->
                            <td class="px-3">

                                <span class="text-body-secondary fs-7">

                                    @if($peminjaman->tanggal_kembali)

                                        <i class="bi bi-calendar-check me-1"></i>
                                        {{ $peminjaman->tanggal_kembali }}

                                    @else

                                        -

                                    @endif

                                </span>

                            </td>

                            <!-- Status Peminjaman -->
                            <td class="px-3">

                                @if($peminjaman->status == 'Pending')

                                    <span class="badge bg-warning-subtle text-warning border border-warning border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-hourglass-split me-1"></i>
                                        Pending
                                    </span>

                                @elseif($peminjaman->status == 'Disetujui')

                                    <span class="badge bg-info-subtle text-info border border-info border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-check2-circle me-1"></i>
                                        Disetujui
                                    </span>

                                @elseif($peminjaman->status == 'Ditolak')

                                    <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Ditolak
                                    </span>

                                @elseif($peminjaman->status == 'Dipinjam')

                                    <span class="badge bg-primary-subtle text-primary border border-primary border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-box-arrow-up-right me-1"></i>
                                        Dipinjam
                                    </span>

                                @else

                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                        <i class="bi bi-check-circle-fill me-1"></i>
                                        Dikembalikan
                                    </span>

                                @endif

                            </td>

                            <!-- Denda -->
                            <td class="px-3">

                                @if(($peminjaman->denda ?? 0) > 0)

                                    <span class="text-danger fw-bold fs-7">
                                        Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}
                                    </span>

                                @else

                                    <span class="text-body-secondary fs-7">
                                        Rp 0
                                    </span>

                                @endif

                            </td>

                            <!-- Aksi -->
                            <td class="px-4 text-center">

                                <div class="d-inline-flex align-items-center justify-content-center gap-1.5">

                                    <a
                                        href="{{ route('peminjaman.edit', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}"
                                        class="btn btn-sm btn-outline-warning fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                        title="Edit Peminjaman">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('peminjaman.delete', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}"
                                        method="POST"
                                        class="d-inline m-0">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')"
                                            title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                            Hapus
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

                                    <h6 class="fw-bold mb-0 text-body">
                                        Belum Ada Data Peminjaman
                                    </h6>

                                    <span class="fs-7 text-body-secondary">
                                        Data peminjaman alat yang diajukan akan muncul di sini.
                                    </span>

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