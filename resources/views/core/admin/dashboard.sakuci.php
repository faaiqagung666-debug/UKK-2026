@extends('layouts.app')

@section('title', config('app.name') . ' -- Panel Administrator')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.20);

        --admin-bg-light:
            radial-gradient(
                circle at 20% 20%,
                rgba(13, 122, 80, 0.08),
                transparent 45%
            ),
            radial-gradient(
                circle at 80% 30%,
                rgba(6, 78, 59, 0.07),
                transparent 45%
            );

        --admin-bg-dark:
            radial-gradient(
                circle at 20% 20%,
                rgba(13, 122, 80, 0.18),
                transparent 45%
            ),
            radial-gradient(
                circle at 80% 30%,
                rgba(217, 242, 75, 0.08),
                transparent 45%
            );
    }

    .badge-brand {
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
        color: #fff !important;
        font-weight: 600;
        letter-spacing: .03em;
        box-shadow: 0 4px 18px var(--brand-glow);
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        border-radius: 2rem;
        padding: .45rem 1rem;
    }

    code.inline {
        background: rgba(13, 122, 80, 0.10);
        color: var(--brand-1);
        padding: .25rem .6rem;
        border-radius: .5rem;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid rgba(13, 122, 80, 0.18);
    }

    .card-brand {
        border: 1px solid rgba(127, 127, 127, 0.12);
        border-radius: 1.5rem;
        background: var(--admin-bg-light);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        position: relative;
        animation: fadeUp .45s ease both;
    }

    .card-brand::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 4px;
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
    }

    .menu-card {
        border: 1px solid rgba(127, 127, 127, 0.12);
        border-radius: 1.25rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.02);
        transition:
            transform .25s cubic-bezier(.165, .84, .44, 1),
            box-shadow .25s ease,
            border-color .25s ease;
        color: inherit;
        background: var(--bs-body-bg);
        position: relative;
        overflow: hidden;
        animation: fadeUp .5s ease both;
    }

    .menu-card:nth-child(1) {
        animation-delay: .05s;
    }

    .menu-card:nth-child(2) {
        animation-delay: .10s;
    }

    .menu-card:nth-child(3) {
        animation-delay: .15s;
    }

    .menu-card::after {
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
        transform: scaleX(.65);
        transform-origin: center;
        transition:
            opacity .25s ease,
            transform .25s ease;
    }

    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 30px rgba(6, 78, 59, 0.10);
        border-color: rgba(13, 122, 80, 0.28);
    }

    .menu-card:hover::after {
        opacity: 1;
        transform: scaleX(1);
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
        transition:
            transform .2s ease,
            background-color .2s ease,
            color .2s ease;
    }

    .menu-card:hover .menu-icon {
        transform: scale(1.08);
    }

    /* Warna ikon diseragamkan dengan tema hijau */
    .menu-card .text-primary,
    .menu-card .text-info,
    .menu-card .text-success {
        color: var(--brand-1) !important;
    }

    .menu-card .bg-primary,
    .menu-card .bg-info,
    .menu-card .bg-success {
        background-color: rgba(13, 122, 80, 0.10) !important;
    }

    .admin-header-icon {
        width: 48px;
        height: 48px;
        font-size: 1.4rem;
        border-radius: .85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(13, 122, 80, 0.10);
        color: var(--brand-1);
        transition:
            transform .2s ease,
            background-color .2s ease;
    }

    .admin-header-icon:hover {
        transform: translateY(-2px);
        background: rgba(13, 122, 80, 0.15);
    }

    /* Support Dark Mode */
    [data-bs-theme="dark"] .card-brand {
        background: var(--admin-bg-dark) !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18);
    }

    [data-bs-theme="dark"] .menu-card {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }

    [data-bs-theme="dark"] .menu-card:hover {
        border-color: rgba(95, 214, 165, 0.30) !important;
        box-shadow: 0 14px 32px rgba(0, 0, 0, 0.25);
    }

    [data-bs-theme="dark"] code.inline {
        background: rgba(95, 214, 165, 0.12);
        color: #5fd6a5;
        border-color: rgba(95, 214, 165, 0.22);
    }

    [data-bs-theme="dark"] .menu-card .text-primary,
    [data-bs-theme="dark"] .menu-card .text-info,
    [data-bs-theme="dark"] .menu-card .text-success {
        color: #5fd6a5 !important;
    }

    [data-bs-theme="dark"] .menu-card .bg-primary,
    [data-bs-theme="dark"] .menu-card .bg-info,
    [data-bs-theme="dark"] .menu-card .bg-success {
        background-color: rgba(95, 214, 165, 0.10) !important;
    }

    [data-bs-theme="dark"] .admin-header-icon {
        background: rgba(95, 214, 165, 0.10);
        color: #5fd6a5;
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

    {{-- Header dengan Ikon di Sebelah Judul Panel --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">

            <div class="admin-header-icon">
                <i class="bi bi-shield-shaded"></i>
            </div>

            <div>
                <h4 class="fw-bold text-body mb-0">
                    Panel Pengelola Admin
                </h4>

                <p class="text-body-secondary small mb-0">
                    Atur hak akses pengguna, struktur role, dan cadangan data sistem.
                </p>
            </div>

        </div>
    </div>

    {{-- BANNER AREA ADMIN --}}
    <div class="card card-brand shadow-sm mb-4">
        <div class="card-body p-4 p-lg-5">

            <span class="badge badge-brand mb-3">
                <i class="bi bi-shield-check"></i>
                Hak Akses Khusus Admin
            </span>

            <h1 class="h3 fw-bold text-body mb-2">
                Halo, {{ $user->username }}! 👋
            </h1>

            <p class="text-body-secondary mb-0" style="max-width: 600px;">
                Halaman ini dikhususkan bagi role
                <code class="inline">admin</code>
                (Middleware terproteksi) untuk mengelola akun pengguna,
                hak akses role, serta ekspor database secara langsung.
            </p>

        </div>
    </div>

    {{-- SEKSI KARTU PINTASAN ADMIN --}}
    <div class="row g-4">

        <!-- Kartu 1: Kelola Role & Akses -->
        <div class="col-md-4">
            <a
                href="{{ route('admin.roles.index') }}"
                class="card menu-card text-decoration-none h-100"
            >
                <div class="card-body p-4">

                    <div class="menu-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>

                    <h2 class="h6 fw-bold mb-1 text-body">
                        Kelola Role & Akses
                    </h2>

                    <p
                        class="text-body-secondary small mb-0"
                        style="line-height: 1.5;"
                    >
                        Atur struktur peran baru untuk membatasi hak akses sistem saat registrasi/penambahan user.
                    </p>

                </div>
            </a>
        </div>

        <!-- Kartu 2: Manajemen Pengguna -->
        <div class="col-md-4">
            <a
                href="{{ route('admin.users.index') }}"
                class="card menu-card text-decoration-none h-100"
            >
                <div class="card-body p-4">

                    <div class="menu-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <h2 class="h6 fw-bold mb-1 text-body">
                        Manajemen Pengguna
                    </h2>

                    <p
                        class="text-body-secondary small mb-0"
                        style="line-height: 1.5;"
                    >
                        Tambah akun pengguna baru, ubah rincian informasi profil, serta tentukan role masing-masing.
                    </p>

                </div>
            </a>
        </div>

        <!-- Kartu 3: Unduh Database SQL -->
        <div class="col-md-4">
            <a
                href="{{ route('admin.database.export') }}"
                class="card menu-card text-decoration-none h-100"
            >
                <div class="card-body p-4">

                    <div class="menu-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-database-down"></i>
                    </div>

                    <h2 class="h6 fw-bold mb-1 text-body">
                        Unduh Database SQL
                    </h2>

                    <p
                        class="text-body-secondary small mb-0"
                        style="line-height: 1.5;"
                    >
                        Ekspor seluruh tabel dan data inventaris ke dalam skrip `.sql` untuk keperluan pencadangan.
                    </p>

                </div>
            </a>
        </div>

    </div>

</div>
@endsection