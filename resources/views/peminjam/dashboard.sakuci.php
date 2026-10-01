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

    /* Hero Banner Modern */
    .dashboard-hero {
        position: relative;
        border-radius: 1.5rem;
        border: 1px solid rgba(127, 127, 127, 0.12);
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);
        overflow: hidden;
        color: #fff;
    }

    .badge-role {
        background: rgba(255, 255, 255, 0.2);
        color: #fff !important;
        font-weight: 600;
        letter-spacing: .05em;
        backdrop-filter: blur(5px);
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        text-transform: uppercase;
        font-size: 0.75rem;
        padding: 0.45rem 1rem;
        border-radius: 2rem;
    }

    /* Kartu Statistik Modern */
    .stat-card {
        border: 1px solid rgba(127, 127, 127, 0.12);
        border-radius: 1.25rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.02);
        transition: all 0.25s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: var(--bs-body-bg);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        border-color: rgba(37, 99, 235, 0.3);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Support Dark Mode Otomatis */
    [data-bs-theme="dark"] .stat-card {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
</style>

<div class="container-fluid py-4 px-4">

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
                Selamat datang di Sistem Inventaris Alat. Silakan pantau status peminjaman dan tagihan denda Anda di bawah ini.
            </p>

            <!-- Tombol Utama -->
            <a href="{{ route('peminjam.createPeminjam') }}" class="btn btn-light text-primary fw-semibold px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-lg fs-5"></i>
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
                        <span class="text-uppercase fw-bold text-muted fs-9 d-block mb-1">Menunggu</span>
                        <h3 class="fw-bold text-warning mb-0">{{ $pendingCount ?? 0 }}</h3>
                        <small class="text-muted fs-8">Persetujuan admin</small>
                    </div>
                    <div class="stat-icon bg-warning-subtle text-warning">
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
                        <span class="text-uppercase fw-bold text-muted fs-9 d-block mb-1">Dipinjam</span>
                        <h3 class="fw-bold text-primary mb-0">{{ $activeCount ?? 0 }}</h3>
                        <small class="text-muted fs-8">Alat yang Anda bawa</small>
                    </div>
                    <div class="stat-icon bg-primary-subtle text-primary">
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
                        <span class="text-uppercase fw-bold text-muted fs-9 d-block mb-1">Selesai</span>
                        <h3 class="fw-bold text-success mb-0">{{ $completedCount ?? 0 }}</h3>
                        <small class="text-muted fs-8">Peminjaman selesai</small>
                    </div>
                    <div class="stat-icon bg-success-subtle text-success">
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
                        <span class="text-uppercase fw-bold text-muted fs-9 d-block mb-1">Total Denda</span>
                        <h3 class="fw-bold text-danger mb-0" style="font-size: 1.25rem;">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h3>
                        <small class="text-muted fs-8">Tagihan denda</small>
                    </div>
                    <div class="stat-icon bg-danger-subtle text-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Petunjuk Singkat Penggunaan -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card stat-card h-100">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary-subtle text-primary">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Pengajuan Peminjaman</h6>
                        <p class="text-body-secondary small mb-0">Klik tombol di atas untuk mengisi formulir alat yang ingin kamu pinjam.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card stat-card h-100">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success-subtle text-success">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Pantau Status & Riwayat</h6>
                        <p class="text-body-secondary small mb-0">Buka menu Riwayat di navigasi untuk melihat status persetujuan alatmu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection