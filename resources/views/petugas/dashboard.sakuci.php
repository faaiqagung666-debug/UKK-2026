@extends('layouts.app')

@section('title', config('app.name') . ' -- Dashboard Petugas')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">

@php
    $currentUser = \App\Models\User::current();
    $role = $currentUser->role ?? 'petugas';

    // Tentukan URL tujuan berdasarkan role user secara dinamis
    if ($role === 'admin') {
        $peminjamanUrl = route('peminjaman.index');
        $pengembalianUrl = route('pengembalian.index');
        $kategoriUrl = route('kategori.index');
        $alatUrl = route('alat.index');
    } elseif ($role === 'petugas') {
        // Disesuaikan dengan rute petugas (Persetujuan & Pantau Pengembalian)
        $peminjamanUrl = route('petugas.peminjaman.index');
        $pengembalianUrl = route('petugas.pengembalian.index');
        $kategoriUrl = route('petugas.peminjaman.index'); // Redirect aman ke peminjaman
        $alatUrl = route('petugas.peminjaman.index'); // Fokus ke verifikasi peminjaman
    } else {
        // Role: Peminjam / Siswa
        $peminjamanUrl = route('peminjam.riwayat'); 
        $pengembalianUrl = route('peminjam.riwayat'); 
        $kategoriUrl = route('peminjam.alat'); 
        $alatUrl = route('peminjam.alat'); 
    }
@endphp

<style>
    /* ============ Token warna & tipografi (senada dengan beranda) ============ */
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(217, 242, 75, 0.35);
        --font-display: 'Bricolage Grotesque', 'Plus Jakarta Sans', system-ui, sans-serif;
        --font-body: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
    }

    .petugas-dashboard { font-family: var(--font-body); }

    /* ============ Hero Dashboard ============ */
    .dashboard-hero {
        position: relative;
        border-radius: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.14);
        background:
            radial-gradient(60% 90% at 100% 0%, rgba(217, 242, 75, 0.16) 0%, rgba(217, 242, 75, 0) 60%),
            linear-gradient(145deg, #0d7a50 0%, #075c3f 42%, #08211b 100%);
        box-shadow: 0 24px 48px -22px rgba(6, 78, 59, 0.55) !important;
        overflow: hidden;
        isolation: isolate;
        transition: border-color 0.3s ease;
    }

    /* Garis lapangan sebagai latar */
    .dashboard-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        opacity: 0.13;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 400' fill='none' stroke='%23ffffff' stroke-width='2'%3E%3Crect x='20' y='20' width='560' height='360'/%3E%3Cpath d='M300 20v360'/%3E%3Ccircle cx='300' cy='200' r='62'/%3E%3Crect x='20' y='120' width='92' height='160'/%3E%3Crect x='488' y='120' width='92' height='160'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: 760px auto;
        background-position: right -130px center;
        -webkit-mask-image: linear-gradient(90deg, transparent 0%, #000 55%);
                mask-image: linear-gradient(90deg, transparent 0%, #000 55%);
    }

    .dashboard-hero h1 {
        font-family: var(--font-display);
        font-weight: 800 !important;
        letter-spacing: -0.02em;
        line-height: 1.15;
        color: #fff !important;
        text-wrap: balance;
    }
    .dashboard-hero p { color: rgba(255, 255, 255, 0.78) !important; }

    .badge-role {
        background: var(--whistle);
        color: #0a2a22 !important;
        font-weight: 700;
        letter-spacing: .05em;
        box-shadow: 0 4px 14px var(--brand-glow);
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        text-transform: uppercase;
        font-size: 0.75rem;
        padding: 0.45rem 1rem;
        border-radius: 2rem;
    }

    /* ============ Judul pintasan ============ */
    .petugas-dashboard h6 {
        font-family: var(--font-display);
        font-weight: 800 !important;
        font-size: 1.05rem;
        letter-spacing: -0.01em;
    }
    .petugas-dashboard .bi-grid-fill { color: var(--brand-1) !important; }

    /* ============ Kartu Pintasan ============ */
    .quick-action-card {
        border: 1px solid var(--bs-border-color-translucent);
        border-radius: 1.25rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        transition: transform 0.25s cubic-bezier(0.165, 0.84, 0.44, 1),
                    box-shadow 0.25s ease, border-color 0.25s ease;
        color: inherit;
        background: var(--bs-body-bg);
        position: relative;
        overflow: hidden;
    }

    /* Garis aksen di bawah kartu */
    .quick-action-card::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--brand-1), var(--whistle));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.35s ease;
    }

    /* Panah kecil di pojok, muncul saat hover sebagai penanda bisa diklik */
    .quick-action-card::before {
        content: "\f138";
        font-family: "bootstrap-icons";
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        font-size: 1.1rem;
        color: var(--brand-1);
        opacity: 0;
        transform: translateX(-8px);
        transition: opacity 0.25s ease, transform 0.25s ease;
    }

    .quick-action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 30px -10px rgba(6, 78, 59, 0.25);
        border-color: rgba(13, 122, 80, 0.4);
    }
    .quick-action-card:hover::after { transform: scaleX(1); }
    .quick-action-card:hover::before { opacity: 1; transform: none; }

    .quick-action-card:focus-visible {
        outline: 3px solid var(--brand-1);
        outline-offset: 3px;
    }

    .action-icon {
        width: 52px;
        height: 52px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        margin-bottom: 1rem;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .quick-action-card:hover .action-icon { transform: scale(1.1) rotate(-6deg); }

    .quick-action-card h2 { font-family: var(--font-display); font-weight: 800 !important; letter-spacing: -0.01em; }

    /* ============ Animasi ============ */
    @keyframes heroIn {
        from { opacity: 0; transform: translateY(18px) scale(0.985); }
        to   { opacity: 1; transform: none; }
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: none; }
    }
    @keyframes courtDrift {
        from { background-position: right -150px center; }
        to   { background-position: right -100px center; }
    }
    @keyframes badgePulse {
        0%   { box-shadow: 0 0 0 0 rgba(217, 242, 75, 0.55); }
        70%  { box-shadow: 0 0 0 10px rgba(217, 242, 75, 0); }
        100% { box-shadow: 0 0 0 0 rgba(217, 242, 75, 0); }
    }

    @media (prefers-reduced-motion: no-preference) {
        .dashboard-hero { animation: heroIn 0.7s cubic-bezier(0.2, 0.7, 0.2, 1) backwards; }
        .dashboard-hero::before { animation: courtDrift 16s ease-in-out infinite alternate; }

        /* Isi hero muncul berurutan */
        .dashboard-hero .card-body > * { animation: fadeUp 0.6s cubic-bezier(0.2, 0.7, 0.2, 1) backwards; }
        .dashboard-hero .card-body > *:nth-child(1) { animation-delay: 0.15s; }
        .dashboard-hero .card-body > *:nth-child(2) { animation-delay: 0.25s; }
        .dashboard-hero .card-body > *:nth-child(3) { animation-delay: 0.35s; }

        .badge-role { animation: badgePulse 2.6s ease-out 1s infinite; }

        /* Judul pintasan dan kartu muncul bergantian */
        .petugas-dashboard > .d-flex.align-items-center.mb-3 { animation: fadeUp 0.5s ease 0.45s backwards; }
        .petugas-dashboard .row.g-4 > [class*="col-"] > .quick-action-card {
            animation: fadeUp 0.55s cubic-bezier(0.2, 0.7, 0.2, 1) backwards;
        }
        .petugas-dashboard .row.g-4 > [class*="col-"]:nth-child(1) > .quick-action-card { animation-delay: 0.55s; }
        .petugas-dashboard .row.g-4 > [class*="col-"]:nth-child(2) > .quick-action-card { animation-delay: 0.65s; }
        .petugas-dashboard .row.g-4 > [class*="col-"]:nth-child(3) > .quick-action-card { animation-delay: 0.75s; }
    }
    @media (prefers-reduced-motion: reduce) {
        .quick-action-card, .quick-action-card::before, .quick-action-card::after, .action-icon { transition: none; }
        .quick-action-card:hover { transform: none; }
    }

    @media (max-width: 576px) {
        .dashboard-hero::before { animation: none; background-size: 520px auto; opacity: 0.1; }
        .dashboard-hero h1 { font-size: 1.4rem; }
    }

    /* Mode gelap: hero dibuat lebih pekat */
    [data-bs-theme="dark"] .dashboard-hero {
        background:
            radial-gradient(60% 90% at 100% 0%, rgba(217, 242, 75, 0.08) 0%, rgba(217, 242, 75, 0) 60%),
            linear-gradient(145deg, #064e3b 0%, #0a2a22 55%, #020a08 100%) !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 24px 48px -22px rgba(0, 0, 0, 0.7) !important;
    }
    [data-bs-theme="dark"] .quick-action-card {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    [data-bs-theme="dark"] .quick-action-card:hover {
        border-color: rgba(217, 242, 75, 0.4) !important;
        box-shadow: 0 16px 30px -10px rgba(0, 0, 0, 0.6);
    }
    [data-bs-theme="dark"] .quick-action-card::before { color: var(--whistle); }
</style>

<div class="petugas-dashboard container-fluid py-4 px-4">
    
    {{-- Banner Utama / Hero Dashboard --}}
    <div class="card dashboard-hero mb-4 shadow-sm">
        <div class="card-body p-4 p-lg-5 position-relative z-1">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="badge badge-role text-capitalize">
                    <i class="bi bi-shield-lock-fill"></i> Role: {{ $role }}
                </span>
            </div>
            
            <h1 class="h3 fw-bold mb-2 text-body">Selamat Datang, {{ $currentUser->nama ?? $currentUser->username ?? 'Petugas' }}! 👋</h1>
            <p class="text-body-secondary mb-0" style="max-width: 620px; font-size: 0.95rem; line-height: 1.6;">
                Panel kendali khusus Petugas Sarpras. Kelola persetujuan peminjaman alat, pantau jadwal pengembalian, dan pastikan inventaris sekolah berjalan tertib.
            </p>
        </div>
    </div>

    {{-- Section Judul Pintasan --}}
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="bi bi-grid-fill text-primary"></i>
        <h6 class="fw-bold mb-0 text-body">Pintasan Fitur Utama Petugas</h6>
    </div>

    {{-- Kartu Pintasan Interaktif (Quick Actions Grid) --}}
    <div class="row g-4">
        
        <!-- Pintasan 1: Persetujuan Peminjaman -->
        <div class="col-md-6 col-xl-4">
            <a href="{{ $peminjamanUrl }}" class="card quick-action-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="action-icon bg-primary-subtle text-primary">
                        <i class="bi bi-check2-square"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Persetujuan Peminjaman</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Verifikasi permohonan peminjaman alat baru dan ubah status persetujuan dengan mudah.
                    </p>
                </div>
            </a>
        </div>

        <!-- Pintasan 2: Pantau Pengembalian -->
        <div class="col-md-6 col-xl-4">
            <a href="{{ $pengembalianUrl }}" class="card quick-action-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="action-icon bg-success-subtle text-success">
                        <i class="bi bi-arrow-return-left"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Pantau Pengembalian</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Monitor jadwal pengembalian alat serta cek rincian denda keterlambatan peminjaman.
                    </p>
                </div>
            </a>
        </div>

        <!-- Pintasan 3: Informasi Panduan / Aktivitas -->
        <div class="col-md-6 col-xl-4">
            <a href="{{ route('home') }}" class="card quick-action-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="action-icon bg-info-subtle text-info">
                        <i class="bi bi-info-circle-fill"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Beranda / Informasi</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Kembali ke halaman utama aplikasi atau lihat ringkasan sistem sarpras sekolah.
                    </p>
                </div>
            </a>
        </div>

    </div>

</div>
@endsection