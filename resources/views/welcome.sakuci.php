@extends('layouts.app')

@section('title', config('app.name') . ' -- Portal Peminjaman Alat Olahraga Sekolah')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">

@php
    $currentUser = \App\Models\User::current();
    $role = $currentUser->role ?? null;

    // Tentukan URL tujuan tombol secara dinamis berdasarkan role user
    if ($role === 'admin') {
        $peminjamanRoute = route('peminjaman.create');
        $katalogRoute = route('alat.index');
    } elseif ($role === 'petugas') {
        $peminjamanRoute = route('petugas.peminjaman.index');
        $katalogRoute = route('alat.index');
    } elseif ($role === 'peminjam') {
        $peminjamanRoute = route('peminjam.createPeminjam');
        $katalogRoute = route('peminjam.alat');
    } else {
        // Jika belum login (tamu)
        $peminjamanRoute = route('login');
        $katalogRoute = route('login');
    }
@endphp

<style>
    /* ============ Token warna & tipografi ============ */
    .portal-section {
        --pitch: #0d7a50;
        --pitch-deep: #064e3b;
        --night: #08211b;
        --whistle: #d9f24b;          /* kuning-lime ala peluit/garis lapangan */
        --font-display: 'Bricolage Grotesque', 'Plus Jakarta Sans', system-ui, sans-serif;
        --font-body: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
        font-family: var(--font-body);
    }

    /* Kelas utilitas yang dipakai di markup tetapi tidak ada di Bootstrap */
    .portal-section .fw-extrabold { font-weight: 800 !important; }
    .portal-section .tracking-tight { letter-spacing: -0.025em; }
    .portal-section .py-2\.5 { padding-top: 0.7rem !important; padding-bottom: 0.7rem !important; }
    .portal-section .fs-7 { font-size: 0.9rem !important; }

    /* ============ Hero ============ */
    .hero-card {
        background:
            radial-gradient(60% 80% at 100% 0%, rgba(217, 242, 75, 0.16) 0%, rgba(217, 242, 75, 0) 60%),
            linear-gradient(145deg, #0d7a50 0%, #075c3f 42%, #08211b 100%);
        border: 1px solid rgba(255, 255, 255, 0.14);
        box-shadow: 0 24px 48px -20px rgba(6, 78, 59, 0.55) !important;
        isolation: isolate;
    }

    [data-bs-theme="dark"] .hero-card {
        background:
            radial-gradient(60% 80% at 100% 0%, rgba(217, 242, 75, 0.08) 0%, rgba(217, 242, 75, 0) 60%),
            linear-gradient(145deg, #064e3b 0%, #0a2a22 55%, #020a08 100%);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 24px 48px -20px rgba(0, 0, 0, 0.7) !important;
    }

    /* Garis lapangan sebagai latar: persegi, garis tengah, lingkaran tengah, area gawang */
    .hero-card::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        opacity: 0.13;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 400' fill='none' stroke='%23ffffff' stroke-width='2'%3E%3Crect x='20' y='20' width='560' height='360'/%3E%3Cpath d='M300 20v360'/%3E%3Ccircle cx='300' cy='200' r='62'/%3E%3Crect x='20' y='120' width='92' height='160'/%3E%3Crect x='488' y='120' width='92' height='160'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: 820px auto;
        background-position: right -140px center;
        -webkit-mask-image: linear-gradient(90deg, transparent 0%, #000 55%);
                mask-image: linear-gradient(90deg, transparent 0%, #000 55%);
    }

    .hero-card .opacity-10 { color: var(--whistle); opacity: 0.07 !important; }

    /* Badge kecil di atas judul */
    .hero-card .badge.bg-warning {
        background-color: var(--whistle) !important;
        color: #0a2a22 !important;
        letter-spacing: 0.02em;
        padding: 0.4em 0.85em;
    }

    .hero-title {
        font-family: var(--font-display);
        font-size: clamp(2rem, 1.2rem + 2.6vw, 3.25rem);
        line-height: 1.08;
        text-wrap: balance;
    }

    .hero-desc {
        font-size: 1.02rem !important;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.78) !important;
    }

    /* ============ Tombol ============ */
    .hero-card .btn {
        font-family: var(--font-body);
        transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
    }

    .hero-card .btn-light {
        background-color: #fff;
        color: var(--pitch-deep) !important;
        border: 2px solid #fff;
    }
    .hero-card .btn-light:hover {
        background-color: var(--whistle);
        border-color: var(--whistle);
        color: #0a2a22 !important;
    }

    .hero-card .btn-outline-light {
        border: 2px solid rgba(255, 255, 255, 0.55);
        background-color: rgba(255, 255, 255, 0.06);
    }
    .hero-card .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.16);
        border-color: #fff;
        color: #fff;
    }

    .hover-lift {
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.22) !important;
    }

    /* Fokus keyboard yang jelas */
    .portal-section a:focus-visible {
        outline: 3px solid var(--whistle);
        outline-offset: 3px;
    }

    /* ============ Kartu info kaca ============ */
    .glass-card {
        background: linear-gradient(160deg, rgba(255, 255, 255, 0.14), rgba(255, 255, 255, 0.05));
        -webkit-backdrop-filter: blur(16px);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.22);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 18px 30px -18px rgba(0, 0, 0, 0.5) !important;
    }

    .icon-box {
        width: 46px;
        height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        flex-shrink: 0;
        transition: transform 0.25s ease;
    }

    .glass-card .icon-box {
        background: rgba(217, 242, 75, 0.16) !important;
        border: 1px solid rgba(217, 242, 75, 0.35);
    }
    .glass-card .icon-box .text-warning { color: var(--whistle) !important; }

    /* ============ Kategori olahraga ============ */
    .portal-section h5 {
        font-family: var(--font-display);
        font-weight: 800 !important;
        letter-spacing: -0.01em;
    }

    .portal-section .row.g-2 > [class*="col-"] > a.card {
        background-color: var(--bs-body-bg) !important;
        border: 1px solid var(--bs-border-color-translucent) !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        position: relative;
        overflow: hidden;
    }

    /* Garis aksen tipis di tepi kiri kartu, muncul saat hover */
    .portal-section .row.g-2 > [class*="col-"] > a.card::after {
        content: "";
        position: absolute;
        left: 0;
        top: 18%;
        bottom: 18%;
        width: 4px;
        border-radius: 0 4px 4px 0;
        background: currentColor;
        opacity: 0;
        transition: opacity 0.25s ease;
    }
    .portal-section .row.g-2 > [class*="col-"] > a.card:hover::after { opacity: 0.9; }
    .portal-section .row.g-2 > [class*="col-"] > a.card:hover .icon-box { transform: scale(1.08) rotate(-4deg); }

    .portal-section .row.g-2 > [class*="col-"]:nth-child(2) > a.card { color: #198754; }
    .portal-section .row.g-2 > [class*="col-"]:nth-child(3) > a.card { color: #0d6efd; }
    .portal-section .row.g-2 > [class*="col-"]:nth-child(4) > a.card { color: #d99a00; }
    .portal-section .row.g-2 > [class*="col-"]:nth-child(5) > a.card { color: #dc3545; }
    .portal-section .row.g-2 > [class*="col-"] > a.card h6,
    .portal-section .row.g-2 > [class*="col-"] > a.card small { color: var(--bs-body-color); }
    .portal-section .row.g-2 > [class*="col-"] > a.card small { opacity: 0.65; }

    /* ============ Animasi ============ */
    @keyframes heroIn {
        from { opacity: 0; transform: translateY(18px) scale(0.985); }
        to   { opacity: 1; transform: none; }
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: none; }
    }
    @keyframes glassIn {
        from { opacity: 0; transform: translateX(28px); }
        to   { opacity: 1; transform: none; }
    }
    @keyframes floatY {
        from { transform: translateY(0); }
        to   { transform: translateY(-10px); }
    }
    @keyframes trophySway {
        0%   { transform: translateY(0) rotate(-3deg); }
        100% { transform: translateY(-14px) rotate(3deg); }
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
    @keyframes shimmer {
        from { transform: translateX(-120%) skewX(-20deg); }
        to   { transform: translateX(260%) skewX(-20deg); }
    }

    /* Kilau yang menyapu tombol utama saat disorot */
    .hero-card .btn-light { position: relative; overflow: hidden; }
    .hero-card .btn-light::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 40%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.75), transparent);
        transform: translateX(-120%) skewX(-20deg);
        pointer-events: none;
    }

    /* Ikon di tombol dan kartu bergerak halus saat hover */
    .hero-card .btn i { transition: transform 0.25s ease; }
    .hero-card .btn:hover i { transform: scale(1.18) rotate(8deg); }

    @media (prefers-reduced-motion: no-preference) {
        /* Hero masuk, lalu isinya muncul berurutan */
        .hero-card { animation: heroIn 0.7s cubic-bezier(0.2, 0.7, 0.2, 1) backwards; }

        .hero-card .col-lg-7 > * { animation: fadeUp 0.6s cubic-bezier(0.2, 0.7, 0.2, 1) backwards; }
        .hero-card .col-lg-7 > *:nth-child(1) { animation-delay: 0.15s; }
        .hero-card .col-lg-7 > *:nth-child(2) { animation-delay: 0.25s; }
        .hero-card .col-lg-7 > *:nth-child(3) { animation-delay: 0.35s; }
        .hero-card .col-lg-7 > *:nth-child(4) { animation-delay: 0.45s; }

        /* Kartu kaca meluncur masuk lalu melayang pelan */
        .glass-card {
            animation: glassIn 0.7s cubic-bezier(0.2, 0.7, 0.2, 1) 0.35s backwards,
                       floatY 5s ease-in-out 1.1s infinite alternate;
        }

        /* Piala di latar bergoyang pelan, garis lapangan bergeser perlahan */
        .hero-card .opacity-10 i {
            display: inline-block;
            animation: trophySway 7s ease-in-out infinite alternate;
        }
        .hero-card::before { animation: courtDrift 16s ease-in-out infinite alternate; }

        /* Badge berdenyut lembut menarik perhatian */
        .hero-card .badge.bg-warning { animation: badgePulse 2.6s ease-out 1s infinite; }

        /* Kilau tombol saat hover */
        .hero-card .btn-light:hover::after { animation: shimmer 0.8s ease; }

        /* Kartu cabang olahraga muncul bergantian */
        .portal-section .row.g-2 > .col-12 { animation: fadeUp 0.5s ease 0.5s backwards; }
        .portal-section .row.g-2 > [class*="col-"]:not(.col-12) > a.card {
            animation: fadeUp 0.55s cubic-bezier(0.2, 0.7, 0.2, 1) backwards;
        }
        .portal-section .row.g-2 > [class*="col-"]:nth-child(2) > a.card { animation-delay: 0.6s; }
        .portal-section .row.g-2 > [class*="col-"]:nth-child(3) > a.card { animation-delay: 0.7s; }
        .portal-section .row.g-2 > [class*="col-"]:nth-child(4) > a.card { animation-delay: 0.8s; }
        .portal-section .row.g-2 > [class*="col-"]:nth-child(5) > a.card { animation-delay: 0.9s; }
    }
    @media (prefers-reduced-motion: reduce) {
        .hover-lift, .icon-box { transition: none; }
        .hover-lift:hover { transform: none; }
    }

    /* Penyesuaian khusus tampilan mobile */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 1.85rem !important;
            line-height: 1.2;
        }
        .hero-desc {
            font-size: 0.92rem !important;
        }
        .hero-card::before {
            background-size: 560px auto;
            background-position: right -160px bottom -40px;
            opacity: 0.1;
            animation: none;
        }
        .btn-action-group {
            width: 100%;
        }
        .btn-action-group .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Hero & Dashboard Section -->
<section class="portal-section py-3 my-1">
    <div class="container px-3 px-md-4">
        
        <!-- CARD HERO UTAMA -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 hero-card text-white shadow-lg rounded-4 p-4 p-lg-5 position-relative overflow-hidden">
                    
                    <!-- Visual Background Graphic -->
                    <div class="position-absolute top-0 end-0 translate-middle-y opacity-10 pe-none d-none d-md-block" style="font-size: 22rem; margin-right: -2rem;">
                        <i class="bi bi-trophy"></i>
                    </div>

                    <div class="row align-items-center position-relative z-1 g-4">
                        <div class="col-lg-7">
                            <div class="d-inline-flex align-items-center gap-2 bg-white bg-opacity-15 px-3 py-1 rounded-pill mb-3">
                                <span class="badge bg-warning text-dark rounded-pill fw-bold">faaiq</span>
                            </div>
                            
                            <h1 class="hero-title fw-extrabold mb-3 text-white tracking-tight fs-2 fs-md-1">
                                Pinjam Alat Olahraga Sekolah Jadi Lebih Mudah & Cepat
                            </h1>
                            <p class="hero-desc text-white-50 fs-6 mb-4" style="max-width: 580px;">
                                Layanan terpadu untuk siswa dan guru pembina. Cari, cek ketersediaan, dan ajukan peminjaman bola, raket, matras, hingga alat atletik secara instan.
                            </p>
                            
                            <!-- Tombol Aksi (Responsif di HP menjadi menumpuk penuh agar mudah ditekan) -->
                            <div class="d-flex flex-column flex-sm-row gap-2 btn-action-group">
                                <a href="{{ $peminjamanRoute }}" class="btn btn-light text-success fw-bold px-4 py-2.5 rounded-pill shadow-sm hover-lift d-inline-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-plus-circle-fill fs-5"></i>
                                    <span>{{ $role === 'peminjam' ? 'Ajukan Peminjaman' : 'Kelola / Ajukan Peminjaman' }}</span>
                                </a>

                                <a href="{{ $katalogRoute }}" class="btn btn-outline-light fw-semibold px-4 py-2.5 rounded-pill hover-lift d-inline-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-grid-3x3-gap-fill"></i>
                                    <span>{{ $role === 'peminjam' ? 'Katalog Alat Olahraga' : 'Lihat Katalog Alat' }}</span>
                                </a>
                            </div>
                        </div>

                        <!-- Card Mini Info di Sisi Right Hero (Hanya tampil di Tablet/Desktop) -->
                        <div class="col-lg-5 d-none d-lg-block">
                            <div class="card glass-card text-white rounded-4 p-4 shadow-sm">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="icon-box bg-white bg-opacity-20 text-white fs-4">
                                        <i class="bi bi-shield-check text-warning"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">Inventaris Terjamin</h6>
                                        <small class="text-white-50">Kondisi alat selalu dicek berkala</small>
                                    </div>
                                </div>
                                <hr class="border-white opacity-20 my-2">
                                <div class="d-flex justify-content-between align-items-center pt-2">
                                    <span class="small text-white-50">Jam Pengambilan Alat</span>
                                    <span class="badge bg-success bg-opacity-25 text-white border border-success border-opacity-50 px-3 py-1 rounded-pill">07.00 - 15.30 WIB</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <!-- BARIS KATEGORI CEPAT ALAT OLAHRAGA -->
        <div class="row g-2 g-md-3">
            <div class="col-12 mb-1">
                <h5 class="fw-bold text-body m-0 fs-6 fs-md-5"><i class="bi bi-grid-fill text-success me-2"></i>Cabang Olahraga Populer</h5>
            </div>
            
            <div class="col-6 col-lg-3">
                <a href="{{ $katalogRoute }}" class="card border-0 bg-body-tertiary p-3 rounded-4 text-decoration-none text-body hover-lift d-flex flex-row align-items-center gap-3 h-100">
                    <div class="icon-box bg-success-subtle text-success rounded-3">
                        <i class="bi bi-dribbble fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold fs-7 fs-md-6">Sepak Bola / Futsal</h6>
                        <small class="text-secondary" style="font-size: 0.75rem;">Bola, Rompi, Gawang</small>
                    </div>
                </a>
            </div>

            <div class="col-6 col-lg-3">
                <a href="{{ $katalogRoute }}" class="card border-0 bg-body-tertiary p-3 rounded-4 text-decoration-none text-body hover-lift d-flex flex-row align-items-center gap-3 h-100">
                    <div class="icon-box bg-primary-subtle text-primary rounded-3">
                        <i class="bi bi-activity fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold fs-7 fs-md-6">Bulu Tangkis</h6>
                        <small class="text-secondary" style="font-size: 0.75rem;">Raket, Kok, Net</small>
                    </div>
                </a>
            </div>

            <div class="col-6 col-lg-3">
                <a href="{{ $katalogRoute }}" class="card border-0 bg-body-tertiary p-3 rounded-4 text-decoration-none text-body hover-lift d-flex flex-row align-items-center gap-3 h-100">
                    <div class="icon-box bg-warning-subtle text-warning rounded-3">
                        <i class="bi bi-circle-half fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold fs-7 fs-md-6">Basket & Voli</h6>
                        <small class="text-secondary" style="font-size: 0.75rem;">Bola Basket, Bola Voli</small>
                    </div>
                </a>
            </div>

            <div class="col-6 col-lg-3">
                <a href="{{ $katalogRoute }}" class="card border-0 bg-body-tertiary p-3 rounded-4 text-decoration-none text-body hover-lift d-flex flex-row align-items-center gap-3 h-100">
                    <div class="icon-box bg-danger-subtle text-danger rounded-3">
                        <i class="bi bi-heart-pulse-fill fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold fs-7 fs-md-6">Senam & Atletik</h6>
                        <small class="text-secondary" style="font-size: 0.75rem;">Matras, Stopwatch, Stop</small>
                    </div>
                </a>
            </div>

        </div>

    </div>
</section>

<!-- Skrip Pengendali Mode Gelap / Terang -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggler = document.getElementById('themeToggler');
        if (!themeToggler) return;
        const themeIcon = document.getElementById('themeIcon');
        const htmlElement = document.documentElement;

        const getPreferredTheme = () => {
            const storedTheme = localStorage.getItem('theme');
            if (storedTheme) {
                return storedTheme;
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        };

        const setTheme = (theme) => {
            htmlElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            
            if (theme === 'dark' && themeIcon) {
                themeIcon.classList.replace('bi-moon-stars-fill', 'bi-sun-fill');
            } else if (themeIcon) {
                themeIcon.classList.replace('bi-sun-fill', 'bi-moon-stars-fill');
            }
        };

        setTheme(getPreferredTheme());

        themeToggler.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        });
    });
</script>
@endsection