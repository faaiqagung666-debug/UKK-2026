@extends('layouts.app')

@section('title', config('app.name') . ' -- Dashboard Peminjaman Alat')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #2563eb;
        --brand-2: #7c3aed;
        --brand-glow: rgba(37, 99, 235, 0.2);
        --dashboard-bg-light: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.08), transparent 45%),
                              radial-gradient(circle at 80% 30%, rgba(124, 58, 237, 0.08), transparent 45%);
        --dashboard-bg-dark: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.18), transparent 45%),
                             radial-gradient(circle at 80% 30%, rgba(124, 58, 237, 0.18), transparent 45%);
    }

    /* Hero Dashboard Modern */
    .dashboard-hero {
        position: relative;
        border-radius: 1.5rem;
        border: 1px solid rgba(127, 127, 127, 0.12);
        background: var(--dashboard-bg-light);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        backdrop-filter: blur(10px);
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    .badge-role {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
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
    }

    /* Kartu Pintasan Interaktif (Quick Action Cards) */
    .quick-action-card {
        border: 1px solid rgba(127, 127, 127, 0.12);
        border-radius: 1.25rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.02);
        transition: all 0.25s cubic-bezier(0.165, 0.84, 0.44, 1);
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
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .quick-action-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        border-color: rgba(37, 99, 235, 0.3);
    }

    .quick-action-card:hover::after {
        opacity: 1;
    }

    .action-icon {
        width: 48px;
        height: 48px;
        border-radius: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }

    /* Support Dark Mode Otomatis */
    [data-bs-theme="dark"] .dashboard-hero {
        background: var(--dashboard-bg-dark) !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    [data-bs-theme="dark"] .quick-action-card {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
</style>

<div class="container-fluid py-4 px-4">
    
    {{-- Banner Utama / Hero Dashboard --}}
    <div class="card dashboard-hero mb-4 shadow-sm">
        <div class="card-body p-4 p-lg-5 position-relative z-1">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="badge badge-role">
                    <i class="bi bi-shield-lock-fill"></i> Role: {{ $user->role ?? 'Pengguna' }}
                </span>
            </div>
            
            <h1 class="h3 fw-bold mb-2 text-body">Selamat Datang, {{ $user->username }}! 👋</h1>
            <p class="text-body-secondary mb-0" style="max-width: 620px; font-size: 0.95rem; line-height: 1.6;">
                Panel kendali utama sistem peminjaman sarpras dan peralatan sekolah. Pilih menu pintasan cepat di bawah ini untuk mengelola dan memantau inventaris.
            </p>
        </div>
    </div>

    {{-- Section Judul Pintasan --}}
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="bi bi-grid-fill text-primary"></i>
        <h6 class="fw-bold mb-0 text-body">Pintasan Fitur Utama</h6>
    </div>

    {{-- Kartu Pintasan Interaktif (Quick Actions Grid) --}}
    <div class="row g-4">
        
        <!-- Pintasan 1: Ajukan Peminjaman -->
        <div class="col-md-6 col-xl-3">
            <a href="{{ route('peminjaman.index') }}" class="card quick-action-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="action-icon bg-primary-subtle text-primary">
                        <i class="bi bi-box-arrow-up-right"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Peminjaman Alat</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Ajukan peminjaman alat sarpras, cek status persetujuan, dan jadwal penggunaan.
                    </p>
                </div>
            </a>
        </div>

        <!-- Pintasan 2: Pengembalian -->
        <div class="col-md-6 col-xl-3">
            <a href="{{ route('pengembalian.index') }}" class="card quick-action-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="action-icon bg-success-subtle text-success">
                        <i class="bi bi-arrow-return-left"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Pengembalian</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Kelola data pengembalian alat, denda keterlambatan, dan pemeriksaan kondisi.
                    </p>
                </div>
            </a>
        </div>

        <!-- Pintasan 3: Kategori Barang -->
        <div class="col-md-6 col-xl-3">
            <a href="{{ route('kategori.index') }}" class="card quick-action-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="action-icon bg-info-subtle text-info">
                        <i class="bi bi-tags-fill"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Kategori Peralatan</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Jelajahi pengelompokan jenis barang guna mempermudah pencarian alat.
                    </p>
                </div>
            </a>
        </div>

        <!-- Pintasan 4: Daftar Alat -->
        <div class="col-md-6 col-xl-3">
            <a href="{{ route('alat.index') }}" class="card quick-action-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="action-icon bg-warning-subtle text-warning">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Daftar Alat</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Periksa ketersediaan alat inventaris sekolah lengkap dengan kodenya.
                    </p>
                </div>
            </a>
        </div>

    </div>

</div>
@endsection