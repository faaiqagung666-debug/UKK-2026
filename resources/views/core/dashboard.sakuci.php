@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <style>
        :root {
            --brand-1: #4f8dff;
            --brand-2: #7c5cff;
            --brand-glow: rgba(79, 141, 255, 0.25);
            --dashboard-bg-light: linear-gradient(135deg, rgba(79, 141, 255, 0.05) 0%, rgba(124, 92, 255, 0.08) 100%);
            --dashboard-bg-dark: linear-gradient(135deg, rgba(79, 141, 255, 0.1) 0%, rgba(124, 92, 255, 0.15) 100%);
        }

        /* Hero Dashboard Mewah */
        .dashboard-hero {
            position: relative;
            border-radius: 1.8rem;
            border: 1px solid rgba(127, 127, 127, 0.15);
            background: var(--dashboard-bg-light);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            backdrop-filter: blur(10px);
            transition: background 0.3s ease, border-color 0.3s ease;
        }

        .dashboard-hero::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(124, 92, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        .dashboard-content {
            position: relative;
            z-index: 1;
        }

        .badge-role {
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            color: #fff !important;
            font-weight: 600;
            letter-spacing: .05em;
            box-shadow: 0 6px 20px var(--brand-glow);
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding: 0.5rem 1.1rem;
            border-radius: 2rem;
        }

        /* Kartu Pintasan Mewah (Glassmorphism & Glow Hover) */
        .quick-action-card {
            border: 1px solid rgba(127, 127, 127, 0.12);
            border-radius: 1.5rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            color: inherit;
            background: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .quick-action-card::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .quick-action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 35px var(--brand-glow);
            border-color: rgba(79, 141, 255, 0.3);
        }

        .quick-action-card:hover::after {
            opacity: 1;
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 1rem;
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
            box-shadow: 0 6px 16px var(--brand-glow);
        }

        /* Support Dark Mode Otomatis (Sistem & Bootstrap 5.3) */
        @media (prefers-color-scheme: dark) {
            .dashboard-hero { 
                background: var(--dashboard-bg-dark) !important; 
                border-color: rgba(255, 255, 255, 0.08) !important; 
            }
            .quick-action-card { 
                background: #1f1f23 !important; 
                border-color: rgba(255, 255, 255, 0.08) !important; 
                color: #f8f9fa !important;
            }
        }

        [data-bs-theme="dark"] .dashboard-hero {
            background: var(--dashboard-bg-dark) !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        [data-bs-theme="dark"] .quick-action-card {
            background: #1f1f23 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            color: #f8f9fa !important;
        }
    </style>

    <div class="container py-4">
        
        {{-- Banner Utama / Hero Dashboard --}}
        <div class="card dashboard-hero mb-4">
            <div class="card-body p-4 p-lg-5 dashboard-content">
                <span class="badge badge-role mb-3">
                    <span>👑</span> Role: {{ $user->role }}
                </span>
                <h1 class="h3 fw-bold mb-2 text-body">Selamat Datang, {{ $user->username }}! ✨</h1>
                <p class="text-secondary mb-0" style="max-width: 620px; font-size: 0.95rem; line-height: 1.6;">
                    Panel kendali utama sistem peminjaman alat sekolah. Pilih menu pintasan di bawah untuk mulai menjelajahi fasilitas dan inventaris yang tersedia.
                </p>
            </div>
        </div>

        {{-- Kartu Pintasan Interaktif (Quick Actions) --}}
        <div class="row g-4">
            <div class="col-md-6">
                <a href="{{ route('kategori.index') }}" class="card quick-action-card text-decoration-none h-100">
                    <div class="card-body p-4 p-lg-4">
                        <div class="action-icon">📂</div>
                        <h2 class="h6 fw-bold mb-2 text-body">Kelola & Lihat Kategori Alat</h2>
                        <p class="text-secondary small mb-0" style="line-height: 1.5;">
                            Jelajahi pengelompokan jenis barang dan alat sekolah guna mempermudah proses pencarian peminjaman.
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('alat.index') }}" class="card quick-action-card text-decoration-none h-100">
                    <div class="card-body p-4 p-lg-4">
                        <div class="action-icon">🔧</div>
                        <h2 class="h6 fw-bold mb-2 text-body">Daftar Inventaris Alat</h2>
                        <p class="text-secondary small mb-0" style="line-height: 1.5;">
                            Periksa ketersediaan alat secara real-time lengkap dengan status kelayakan dan riwayat penggunaannya.
                        </p>
                    </div>
                </a>
            </div>
        </div>

    </div>

@endsection