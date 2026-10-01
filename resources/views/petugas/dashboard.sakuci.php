@extends('layouts.app')

@section('title', config('app.name') . ' -- Dashboard Petugas')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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