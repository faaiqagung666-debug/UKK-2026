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
        width: 52px;
        height: 52px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1.25rem;
        transition: transform 0.2s ease;
    }

    .menu-card:hover .menu-icon {
        transform: scale(1.08);
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
    
    {{-- Header dengan Ikon di Sebelah Judul Panel --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 1.4rem;">
                <i class="bi bi-shield-shaded"></i>
            </div>
            <div>
                <h4 class="fw-bold text-body mb-0">Panel Pengelola Admin</h4>
                <p class="text-body-secondary small mb-0">Atur hak akses pengguna, struktur role, dan cadangan data sistem.</p>
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
        
        <!-- Kartu 1: Kelola Role & Akses -->
        <div class="col-md-4">
            <a href="{{ route('admin.roles.index') }}" class="card menu-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="menu-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Kelola Role & Akses</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Atur struktur peran baru untuk membatasi hak akses sistem saat registrasi/penambahan user.
                    </p>
                </div>
            </a>
        </div>

        <!-- Kartu 2: Manajemen Pengguna -->
        <div class="col-md-4">
            <a href="{{ route('admin.users.index') }}" class="card menu-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="menu-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h2 class="h6 fw-bold mb-1 text-body">Manajemen Pengguna</h2>
                    <p class="text-body-secondary small mb-0" style="line-height: 1.5;">
                        Tambah akun pengguna baru, ubah rincian informasi profil, serta tentukan role masing-masing.
                    </p>
                </div>
            </a>
        </div>

        <!-- Kartu 3: Unduh Database SQL -->
        <div class="col-md-4">
            <a href="{{ route('admin.database.export') }}" class="card menu-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="menu-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-database-down"></i>
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