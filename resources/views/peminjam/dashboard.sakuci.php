@extends('layouts.app')

@section('title', config('app.name') . ' -- Dashboard Peminjaman Alat')

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
    }

    /* =========================
       BASE
    ========================= */
    .dashboard-peminjaman-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .dashboard-peminjaman-page h1,
    .dashboard-peminjaman-page h2,
    .dashboard-peminjaman-page h3,
    .dashboard-peminjaman-page h4,
    .dashboard-peminjaman-page h5 {
        font-family: 'Bricolage Grotesque', sans-serif;
    }

    /* =========================
       HERO BANNER
    ========================= */
    .dashboard-hero {
        position: relative;
        border-radius: 1.5rem;
        border: 1px solid rgba(127, 127, 127, 0.12);
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
        box-shadow: 0 12px 35px rgba(13, 122, 80, 0.25);
        overflow: hidden;
        color: #fff;
        animation: heroIn .65s ease both;
    }

    /* Background garis lapangan */
    .dashboard-hero::before,
    .dashboard-hero::after {
        content: "";
        position: absolute;
        pointer-events: none;
        border: 2px solid rgba(217, 242, 75, 0.16);
        border-radius: 50%;
    }

    .dashboard-hero::before {
        width: 360px;
        height: 360px;
        right: -130px;
        top: -190px;
    }

    .dashboard-hero::after {
        width: 260px;
        height: 260px;
        left: -130px;
        bottom: -170px;
    }

    .dashboard-hero .card-body {
        position: relative;
        z-index: 2;
    }

    .dashboard-hero h2 {
        font-weight: 800;
        letter-spacing: -0.03em;
    }

    .dashboard-hero p {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* =========================
       ROLE BADGE
    ========================= */
    .badge-role {
        background: var(--whistle);
        color: var(--brand-2) !important;
        font-weight: 800;
        letter-spacing: .05em;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        text-transform: uppercase;
        font-size: 0.75rem;
        padding: 0.45rem 1rem;
        border-radius: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.10);
        animation: badgePulse 2.8s ease-in-out infinite;
    }

    /* =========================
       BUTTON
    ========================= */
    .dashboard-hero .btn-light.text-primary {
        background: #fff !important;
        color: var(--brand-2) !important;
        border: 0 !important;
        border-radius: 999px !important;
        padding: .65rem 1.2rem !important;
        font-weight: 700 !important;
        transition: all .25s ease;
    }

    .dashboard-hero .btn-light.text-primary:hover {
        background: var(--whistle) !important;
        color: var(--brand-2) !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .14) !important;
    }

    /* =========================
       STAT CARD
    ========================= */
    .stat-card {
        border: 1px solid var(--brand-border);
        border-radius: 1.25rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        transition: all .3s cubic-bezier(.165, .84, .44, 1);
        background: var(--bs-body-bg);
        position: relative;
        overflow: hidden;
        animation: fadeUp .55s ease both;
    }

    .stat-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--brand-1);
        transform: scaleY(0);
        transform-origin: bottom;
        transition: transform .3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(13, 122, 80, 0.12);
        border-color: rgba(13, 122, 80, 0.35);
    }

    .stat-card:hover::before {
        transform: scaleY(1);
    }

    /* =========================
       STAT ICON
    ========================= */
    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        transition: all .3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.08) rotate(-3deg);
    }

    /* =========================
       STAT LABEL
    ========================= */
    .stat-label {
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        font-weight: 800;
        color: var(--bs-secondary-color);
    }

    .stat-card h3 {
        letter-spacing: -0.02em;
    }

    /* Ganti warna primary Bootstrap menjadi hijau */
    .stat-card .text-primary {
        color: var(--brand-1) !important;
    }

    .stat-card .bg-primary {
        background-color: var(--brand-1) !important;
    }

    /* =========================
       ANIMATIONS
    ========================= */
    @keyframes heroIn {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes badgePulse {
        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.03);
        }
    }

    /* =========================
       DARK MODE
    ========================= */
    [data-bs-theme="dark"] .stat-card {
        border-color: rgba(255, 255, 255, 0.08) !important;
        background: rgba(255, 255, 255, 0.025);
    }

    [data-bs-theme="dark"] .stat-card:hover {
        border-color: rgba(217, 242, 75, 0.25) !important;
        box-shadow: 0 12px 30px rgba(13, 122, 80, 0.18);
    }

    [data-bs-theme="dark"] .stat-label {
        color: var(--bs-secondary-color);
    }

    [data-bs-theme="dark"] .dashboard-hero {
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.28);
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media (max-width: 768px) {
        .dashboard-hero {
            border-radius: 1.25rem;
        }

        .dashboard-hero .card-body {
            padding: 1.5rem !important;
        }

        .dashboard-hero h2 {
            font-size: 1.55rem;
        }

        .dashboard-hero p {
            font-size: .9rem !important;
        }

        .stat-card {
            border-radius: 1.1rem;
        }
    }
</style>

<div class="container-fluid py-4 px-4 dashboard-peminjaman-page">

    <!-- Card Banner Utama -->
    <div class="card dashboard-hero border-0 mb-4">
        <div class="card-body p-4 p-md-5 position-relative z-1">
            
            <!-- Badge Role -->
            <span class="badge badge-role mb-3">
                <i class="bi bi-shield-lock-fill"></i> Role: {{ $user->role ?? 'Siswa' }}
            </span>

            <!-- Ucapan Selamat Datang -->
            <h2 class="fw-bold mb-2">Halo, {{ $user->username ?? 'User' }}! 👋</h2>
            <p class="mb-4 opacity-75 fs-6" style="max-width: 600px;">
                Selamat datang di Sistem Inventaris Alat. Silakan pantau status peminjaman dan tagihan denda Anda melalui ringkasan di bawah ini.
            </p>

            <!-- Tombol Utama -->
            <a href="{{ route('peminjam.createPeminjam') }}" class="btn btn-light text-primary fw-semibold px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill fs-5"></i>
                <span>Ajukan Peminjaman Baru</span>
            </a>

        </div>
    </div>

    <!-- 4 KARTU STATISTIK & DENDA -->
    <div class="row g-3 mb-4">

        <!-- Kartu Menunggu -->
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase stat-label d-block mb-1">Menunggu</span>
                        <h3 class="fw-bold text-warning mb-0">{{ $pendingCount ?? 0 }}</h3>
                        <small class="text-muted fs-8">Persetujuan admin</small>
                    </div>

                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Dipinjam -->
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase stat-label d-block mb-1">Dipinjam</span>
                        <h3 class="fw-bold text-primary mb-0">{{ $activeCount ?? 0 }}</h3>
                        <small class="text-muted fs-8">Alat yang Anda bawa</small>
                    </div>

                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Selesai -->
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase stat-label d-block mb-1">Selesai</span>
                        <h3 class="fw-bold text-success mb-0">{{ $completedCount ?? 0 }}</h3>
                        <small class="text-muted fs-8">Peminjaman selesai</small>
                    </div>

                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Total Denda -->
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase stat-label d-block mb-1">Total Denda</span>
                        <h3 class="fw-bold text-danger mb-0" style="font-size: 1.25rem;">
                            Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}
                        </h3>
                        <small class="text-muted fs-8">Tagihan denda</small>
                    </div>

                    <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection