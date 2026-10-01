@extends('layouts.app')

@section('title', config('app.name') . ' -- Dashboard Peminjaman Alat')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@php
    $currentUser = \App\Models\User::current();
    $role = $currentUser->role ?? 'peminjam';

    // Tentukan URL tujuan berdasarkan role user secara dinamis
    if ($role === 'admin') {
        $peminjamanUrl = route('peminjaman.index');
        $pengembalianUrl = route('pengembalian.index');
        $kategoriUrl = route('kategori.index');
        $alatUrl = route('alat.index');
    } elseif ($role === 'petugas') {
        $peminjamanUrl = route('petugas.peminjaman.index');
        $pengembalianUrl = route('petugas.pengembalian.index');
        $kategoriUrl = route('home'); // Sesuaikan jika petugas punya rute kategori
        $alatUrl = route('alat.index');
    } else {
        // Role: Peminjam / Siswa
        $peminjamanUrl = route('peminjam.riwayat'); // Mengarah ke riwayat / pengajuan peminjam
        $pengembalianUrl = route('peminjam.riwayat'); // Peminjam melihat status di riwayat
        $kategoriUrl = route('peminjam.alat'); // Katalog alat peminjam
        $alatUrl = route('peminjam.alat'); // Katalog alat peminjam
    }
@endphp

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-soft: #eaf8f1;
        --brand-glow: rgba(13, 122, 80, 0.20);

        --dashboard-bg-light:
            radial-gradient(
                circle at 20% 20%,
                rgba(13, 122, 80, 0.09),
                transparent 45%
            ),
            radial-gradient(
                circle at 80% 30%,
                rgba(217, 242, 75, 0.10),
                transparent 45%
            );

        --dashboard-bg-dark:
            radial-gradient(
                circle at 20% 20%,
                rgba(13, 122, 80, 0.20),
                transparent 45%
            ),
            radial-gradient(
                circle at 80% 30%,
                rgba(217, 242, 75, 0.10),
                transparent 45%
            );
    }

    /* =========================================
       HERO DASHBOARD
    ========================================= */
    .dashboard-hero {
        position: relative;
        border-radius: 1.5rem;
        border: 1px solid rgba(13, 122, 80, 0.14);
        background: var(--dashboard-bg-light);
        box-shadow: 0 10px 30px rgba(6, 78, 59, 0.04);
        overflow: hidden;
        backdrop-filter: blur(10px);
        transition:
            background .3s ease,
            border-color .3s ease,
            box-shadow .3s ease,
            transform .25s ease;
    }

    .dashboard-hero:hover {
        box-shadow: 0 14px 35px rgba(6, 78, 59, 0.08);
        transform: translateY(-1px);
    }

    .dashboard-hero::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        right: -80px;
        top: -100px;
        border-radius: 50%;
        background: rgba(217, 242, 75, 0.10);
        pointer-events: none;
    }

    /* =========================================
       ROLE BADGE
    ========================================= */
    .badge-role {
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
        color: #fff !important;
        font-weight: 600;
        letter-spacing: .05em;
        box-shadow: 0 4px 14px var(--brand-glow);
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        text-transform: uppercase;
        font-size: 0.75rem;
        padding: 0.45rem 1rem;
        border-radius: 2rem;
        animation: badgePulse 2.8s ease-in-out infinite;
    }

    /* =========================================
       QUICK ACTION CARDS
    ========================================= */
    .quick-action-card {
        border: 1px solid rgba(13, 122, 80, 0.13);
        border-radius: 1.25rem;
        box-shadow: 0 6px 18px rgba(6, 78, 59, 0.025);
        transition:
            transform .25s cubic-bezier(.165, .84, .44, 1),
            box-shadow .25s ease,
            border-color .25s ease,
            background-color .25s ease;
        color: inherit;
        background: var(--bs-body-bg);
        position: relative;
        overflow: hidden;
    }

    .quick-action-card::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
        opacity: 0;
        transition: opacity .25s ease;
    }

    .quick-action-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(6, 78, 59, 0.10);
        border-color: rgba(13, 122, 80, 0.30);
    }

    .quick-action-card:hover::after {
        opacity: 1;
    }

    /* =========================================
       ACTION ICON
    ========================================= */
    .action-icon {
        width: 48px;
        height: 48px;
        border-radius: .85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 1rem;
        transition:
            transform .25s ease,
            box-shadow .25s ease;
    }

    .quick-action-card:hover .action-icon {
        transform: translateY(-3px) scale(1.04);
    }

    /* Warna ikon diseragamkan dengan brand hijau */
    .action-icon.bg-primary-subtle {
        background-color: rgba(13, 122, 80, .11) !important;
        color: var(--brand-1) !important;
    }

    .action-icon.bg-success-subtle {
        background-color: rgba(13, 122, 80, .11) !important;
        color: var(--brand-1) !important;
    }

    .action-icon.bg-info-subtle {
        background-color: rgba(217, 242, 75, .20) !important;
        color: var(--brand-2) !important;
    }

    .action-icon.bg-warning-subtle {
        background-color: rgba(217, 242, 75, .20) !important;
        color: var(--brand-2) !important;
    }

    /* =========================================
       SECTION TITLE
    ========================================= */
    .feature-title-icon {
        color: var(--brand-1) !important;
    }

    /* =========================================
       DARK MODE
    ========================================= */
    [data-bs-theme="dark"] .dashboard-hero {
        background: var(--dashboard-bg-dark) !important;
        border-color: rgba(255, 255, 255, .08) !important;
    }

    [data-bs-theme="dark"] .quick-action-card {
        border-color: rgba(255, 255, 255, .08) !important;
    }

    [data-bs-theme="dark"] .quick-action-card:hover {
        border-color: rgba(95, 214, 165, .30) !important;
        box-shadow: 0 12px 28px rgba(0, 0, 0, .20);
    }

    [data-bs-theme="dark"] .action-icon.bg-primary-subtle,
    [data-bs-theme="dark"] .action-icon.bg-success-subtle {
        background-color: rgba(95, 214, 165, .12) !important;
        color: #5fd6a5 !important;
    }

    [data-bs-theme="dark"] .action-icon.bg-info-subtle,
    [data-bs-theme="dark"] .action-icon.bg-warning-subtle {
        background-color: rgba(217, 242, 75, .12) !important;
        color: var(--whistle) !important;
    }

    [data-bs-theme="dark"] .feature-title-icon {
        color: #5fd6a5 !important;
    }

    /* =========================================
       ANIMATIONS
    ========================================= */
    .dashboard-hero {
        animation: heroIn .5s ease both;
    }

    .quick-action-card {
        animation: fadeUp .5s ease both;
    }

    .quick-action-card:nth-child(1) {
        animation-delay: .05s;
    }

    .quick-action-card:nth-child(2) {
        animation-delay: .10s;
    }

    .quick-action-card:nth-child(3) {
        animation-delay: .15s;
    }

    .quick-action-card:nth-child(4) {
        animation-delay: .20s;
    }

    @keyframes heroIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
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
        0%,
        100% {
            box-shadow: 0 4px 14px rgba(13, 122, 80, .20);
        }

        50% {
            box-shadow: 0 6px 22px rgba(217, 242, 75, .20);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="container-fluid py-4 px-4">

    {{-- Banner Utama / Hero Dashboard --}}
    <div class="card dashboard-hero mb-4 shadow-sm">
        <div class="card-body p-4 p-lg-5 position-relative z-1">

            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="badge badge-role text-capitalize">
                    <i class="bi bi-shield-lock-fill"></i>
                    Role: {{ $role }}
                </span>
            </div>

            <h1 class="h3 fw-bold mb-2 text-body">
                Selamat Datang, {{ $currentUser->username ?? 'Pengguna' }}! 👋
            </h1>

            <p class="text-body-secondary mb-0"
               style="max-width: 620px; font-size: 0.95rem; line-height: 1.6;">
                Panel kendali utama sistem peminjaman sarpras dan peralatan sekolah.
                Pilih menu pintasan cepat di bawah ini untuk mengelola dan memantau inventaris.
            </p>
        </div>
    </div>

    {{-- Section Judul Pintasan --}}
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="bi bi-grid-fill feature-title-icon"></i>
        <h6 class="fw-bold mb-0 text-body">
            Pintasan Fitur Utama
        </h6>
    </div>

    {{-- Kartu Pintasan Interaktif (Quick Actions Grid) --}}
    <div class="row g-4">

        <!-- Pintasan 1: Peminjaman Alat -->
        <div class="col-md-6 col-xl-3">
            <a href="{{ $peminjamanUrl }}"
               class="card quick-action-card text-decoration-none h-100">

                <div class="card-body p-4">
                    <div class="action-icon bg-primary-subtle text-primary">
                        <i class="bi bi-box-arrow-up-right"></i>
                    </div>

                    <h2 class="h6 fw-bold mb-1 text-body">
                        Peminjaman Alat
                    </h2>

                    <p class="text-body-secondary small mb-0"
                       style="line-height: 1.5;">
                        {{ $role === 'peminjam'
                            ? 'Ajukan peminjaman alat baru dan pantau daftar riwayat.'
                            : 'Kelola peminjaman alat sarpras dan cek status persetujuan.' }}
                    </p>
                </div>
            </a>
        </div>

        <!-- Pintasan 2: Pengembalian -->
        <div class="col-md-6 col-xl-3">
            <a href="{{ $pengembalianUrl }}"
               class="card quick-action-card text-decoration-none h-100">

                <div class="card-body p-4">
                    <div class="action-icon bg-success-subtle text-success">
                        <i class="bi bi-arrow-return-left"></i>
                    </div>

                    <h2 class="h6 fw-bold mb-1 text-body">
                        Pengembalian
                    </h2>

                    <p class="text-body-secondary small mb-0"
                       style="line-height: 1.5;">
                        {{ $role === 'peminjam'
                            ? 'Periksa status pengembalian barang dan rincian denda Anda.'
                            : 'Kelola data pengembalian alat dan denda keterlambatan.' }}
                    </p>
                </div>
            </a>
        </div>

        <!-- Pintasan 3: Kategori Barang -->
        <div class="col-md-6 col-xl-3">
            <a href="{{ $kategoriUrl }}"
               class="card quick-action-card text-decoration-none h-100">

                <div class="card-body p-4">
                    <div class="action-icon bg-info-subtle text-info">
                        <i class="bi bi-tags-fill"></i>
                    </div>

                    <h2 class="h6 fw-bold mb-1 text-body">
                        Kategori Peralatan
                    </h2>

                    <p class="text-body-secondary small mb-0"
                       style="line-height: 1.5;">
                        Jelajahi pengelompokan jenis barang guna mempermudah pencarian alat.
                    </p>
                </div>
            </a>
        </div>

        <!-- Pintasan 4: Daftar Alat -->
        <div class="col-md-6 col-xl-3">
            <a href="{{ $alatUrl }}"
               class="card quick-action-card text-decoration-none h-100">

                <div class="card-body p-4">
                    <div class="action-icon bg-warning-subtle text-warning">
                        <i class="bi bi-tools"></i>
                    </div>

                    <h2 class="h6 fw-bold mb-1 text-body">
                        Daftar Alat
                    </h2>

                    <p class="text-body-secondary small mb-0"
                       style="line-height: 1.5;">
                        {{ $role === 'peminjam'
                            ? 'Lihat katalog alat sekolah yang tersedia untuk dipinjam.'
                            : 'Periksa ketersediaan alat inventaris lengkap dengan kodenya.' }}
                    </p>
                </div>
            </a>
        </div>

    </div>

</div>
@endsection