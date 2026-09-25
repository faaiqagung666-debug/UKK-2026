@extends('layouts.app')

@section('title', config('app.name') . ' -- Panel Administrator')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #2563eb;
        --brand-2: #7c3aed;
        --brand-glow: rgba(37, 99, 235, 0.2);
        --admin-bg-light: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.08), transparent 45%),
                           radial-gradient(circle at 80% 30%, rgba(124, 58, 237, 0.08), transparent 45%);
        --admin-bg-dark: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.18), transparent 45%),
                          radial-gradient(circle at 80% 30%, rgba(124, 58, 237, 0.18), transparent 45%);
    }

    .badge-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        color: #fff !important;
        font-weight: 600;
        letter-spacing: .03em;
        box-shadow: 0 4px 18px var(--brand-glow);
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        border-radius: 2rem;
        padding: 0.45rem 1rem;
    }

    code.inline {
        background: rgba(37, 99, 235, 0.1);
        color: var(--brand-1);
        padding: .25rem .6rem;
        border-radius: .5rem;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid rgba(37, 99, 235, 0.18);
    }

    .card-brand {
        border: 1px solid rgba(127, 127, 127, 0.12);
        border-radius: 1.5rem;
        background: var(--admin-bg-light);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
    }

    .menu-card {
        border: 1px solid rgba(127, 127, 127, 0.12);
        border-radius: 1.25rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.02);
        transition: all 0.25s cubic-bezier(0.165, 0.84, 0.44, 1);
        color: inherit;
        background: var(--bs-body-bg);
        position: relative;
        overflow: hidden;
    }

    .menu-card::after {
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

    .menu-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        border-color: rgba(37, 99, 235, 0.3);
    }

    .menu-card:hover::after {
        opacity: 1;
    }

    .menu-icon {
        width: 48px;
        height: 48px;
        border-radius: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }

    /* Styling Tombol Titik Tiga (Sidebar Toggler) */
    .btn-menu-toggle {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        border: none;
        border-radius: 0.85rem;
        width: 44px;
        height: 44px;
        color: #ffffff;
        box-shadow: 0 4px 15px var(--brand-glow);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-menu-toggle:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        color: #ffffff;
    }

    /* Sidebar Navigasi */
    .sidebar-nav .nav-link {
        color: var(--bs-body-color);
        border-radius: 0.75rem;
        padding: 0.7rem 1rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .sidebar-nav .nav-link:hover,
    .sidebar-nav .nav-link.active {
        background: rgba(37, 99, 235, 0.1);
        color: var(--brand-1) !important;
    }

    /* Support Dark Mode Otomatis */
    [data-bs-theme="dark"] .card-brand {
        background: var(--admin-bg-dark) !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    [data-bs-theme="dark"] .menu-card {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    [data-bs-theme="dark"] code.inline {
        background: rgba(96, 165, 250, 0.15);
        color: #93c5fd;
        border-color: rgba(96, 165, 250, 0.25);
    }
</style>

<div class="container-fluid py-4 px-4">
    
    {{-- Header & Tombol Buka Sidebar --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-menu-toggle d-flex align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar" aria-controls="adminSidebar" title="Buka Menu Admin">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div>
                <h4 class="fw-bold text-body mb-0">Panel Pengelola Admin</h4>
                <p class="text-body-secondary small mb-0">Atur hak akses pengguna, struktur role, dan cadangan data sistem.</p>
            </div>
        </div>
    </div>

    {{-- SIDEBAR OFFCANVAS --}}
    <div class="offcanvas offcanvas-start border-end shadow" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
        <div class="offcanvas-header border-bottom py-3">
            <div class="d-flex align-items-center gap-2">
                <div class="bg-primary text-white rounded-3 p-1.5 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                    <i class="bi bi-shield-lock-fill fs-6"></i>
                </div>
                <h5 class="offcanvas-title fw-bold text-body" id="adminSidebarLabel">Menu Navigasi</h5>
            </div>
            <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body d-flex flex-column p-3">
            <div class="mb-3 px-2 py-2 bg-body-tertiary rounded-3 border">
                <span class="text-uppercase text-body-secondary fw-bold fs-9" style="letter-spacing: .08em;">Pengguna Aktif</span>
                <div class="fw-bold fs-6 text-truncate text-body">{{ $user->username }}</div>
            </div>

            <ul class="nav flex-column gap-1 sidebar-nav mb-4">
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link d-flex align-items-center gap-2">
                        <i class="bi bi-tags-fill text-primary"></i>
                        <span>Kelola Kategori Alat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('alat.index') }}" class="nav-link d-flex align-items-center gap-2">
                        <i class="bi bi-tools text-warning"></i>
                        <span>Kelola Inventaris Alat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('peminjaman.index') }}" class="nav-link d-flex align-items-center gap-2">
                        <i class="bi bi-box-arrow-up-right text-info"></i>
                        <span>Daftar Peminjaman</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pengembalian.index') }}" class="nav-link d-flex align-items-center gap-2">
                        <i class="bi bi-arrow-return-left text-success"></i>
                        <span>Daftar Pengembalian</span>
                    </a>
                </li>
            </ul>

            <div class="mt-auto pt-3 border-top px-2">
                <p class="text-body-secondary small mb-0">
                    Otorisasi Role: <code class="inline">admin</code>
                </p>
            </div>
        </div>
    </div>

    {{-- BANNER AREA ADMIN --}}
    <div class="card card-brand shadow-sm mb-4">
        <div class="card-body p-4 p-lg-5">
            <span class="badge badge-brand mb-3">
                <i class="bi bi-shield-check"></i> Hak Akses Khusus Admin
            </span>
            <h1 class="h3 fw-bold text-body mb-2">Halo, {{ $user->username }}! 👋</h1>
            <p class="text-body-secondary mb-0" style="max-width: 600px;">
                Halaman ini dikhususkan bagi role <code class="inline">admin</code> (Middleware terproteksi) untuk mengelola akun pengguna, hak akses role, serta ekspor database secara langsung.
            </p>
        </div>
    </div>

    {{-- SEKSI KARTU PINTASAN ADMIN --}}
    <div class="row g-4">
        
        <!-- Kartu 1: Tambah & Kelola Role -->
        <div class="col-md-4">
            <a href="{{ route('admin.roles.index') }}" class="card menu-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="menu-icon bg-primary-subtle text-primary">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Kelola Role & Akses</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Atur struktur peran baru untuk membatasi hak akses sistem saat registrasi/penambahan user.
                    </p>
                </div>
            </a>
        </div>

        <!-- Kartu 2: Manage User -->
        <div class="col-md-4">
            <a href="{{ route('admin.users.index') }}" class="card menu-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="menu-icon bg-info-subtle text-info">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Manajemen Pengguna</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Tambah akun pengguna baru, ubah rincian informasi profil, serta tentukan role masing-masing.
                    </p>
                </div>
            </a>
        </div>

        <!-- Kartu 3: Backup Database -->
        <div class="col-md-4">
            <a href="{{ route('admin.database.export') }}" class="card menu-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="menu-icon bg-success-subtle text-success">
                        <i class="bi bi-database-fill-down"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Unduh Database SQL</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Ekspor seluruh tabel dan data inventaris ke dalam skrip `.sql` untuk keperluan pencadangan.
                    </p>
                </div>
            </a>
        </div>

    </div>

</div>
@endsection