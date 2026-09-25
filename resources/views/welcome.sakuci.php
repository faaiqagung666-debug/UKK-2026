@extends('layouts.app')

@section('title', config('app.name') . ' -- Portal Peminjaman Sarpras Sekolah')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Gradient Hero & Smooth Hover Effects */
    .hero-card {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 40%, #0f172a 100%);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    
    [data-bs-theme="dark"] .hero-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 60%, #020617 100%);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .hover-lift {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.12) !important;
    }

    /* Glassmorphism accent */
    .glass-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .icon-box {
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
    }
</style>

<!-- Hero & Dashboard Section -->
<section class="py-4 my-2">
    <div class="container">
        
        <!-- CARD HERO UTAMA -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 hero-card text-white shadow-lg rounded-4 p-4 p-lg-5 position-relative overflow-hidden">
                    
                    

                    <!-- Visual Background Graphic -->
                    <div class="position-absolute top-0 end-0 translate-middle-y opacity-10 pe-none d-none d-md-block" style="font-size: 22rem; margin-right: -2rem;">
                        <i class="bi bi-mortarboard"></i>
                    </div>

                    <div class="row align-items-center position-relative z-1 g-4">
                        <div class="col-lg-7">
                            <div class="d-inline-flex align-items-center gap-2 bg-white bg-opacity-15 px-3 py-1.5 rounded-pill mb-3 backdrop-blur">
                                <span class="badge bg-warning text-dark rounded-pill fw-bold">faaiq</span>
                            </div>
                            
                            <h1 class="display-5 fw-extrabold mb-3 text-white tracking-tight">
                                Pinjam Alat Praktik & Sarana Sekolah Lebih Mudah
                            </h1>
                            <p class="text-white-50 lead fs-6 mb-4" style="max-width: 580px;">
                                Layanan terpadu untuk siswa dan guru. Cari, cek ketersediaan, dan ajukan peminjaman proyektor, peralatan lab, hingga alat olahraga secara instan.
                            </p>
                            
                            <!-- Tombol Mulai / Ajukan Peminjaman -->
                            <a href="{{ route('peminjaman.create') }}" class="btn btn-light text-primary fw-bold px-4 py-2.5 rounded-pill shadow-sm hover-lift d-inline-flex align-items-center gap-2">
                            <i class="bi bi-plus-circle-fill fs-5"></i>
                            <span>Ajukan Peminjaman</span>
                            </a>

                            <!-- Tombol Lihat Katalog / Dashboard Alat -->
                            <a href="{{ route('alat.index') }}" class="btn btn-outline-light fw-semibold px-4 py-2.5 rounded-pill hover-lift d-inline-flex align-items-center gap-2">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                            <span>Lihat Katalog Alat</span>
                            </a>
                        </div>

                        <!-- Card Mini Info di Sisi Right Hero -->
                        <div class="col-lg-5 d-none d-lg-block">
                            <div class="card glass-card text-white rounded-4 p-4 shadow-sm">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="icon-box bg-white bg-opacity-20 text-white fs-4">
                                        <i class="bi bi-lightning-charge-fill text-warning"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">Proses Cepat & Praktis</h6>
                                        <small class="text-white-50">Verifikasi otomatis via akun sekolah</small>
                                    </div>
                                </div>
                                <hr class="border-white opacity-20 my-2">
                                <div class="d-flex justify-content-between align-items-center pt-2">
                                    <span class="small text-white-50">Jam Operasional Sarpras</span>
                                    <span class="badge bg-success bg-opacity-25 text-white border border-success border-opacity-50 px-3 py-1 rounded-pill">07.00 - 15.30 WIB</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

       
        <!-- BARIS KATEGORI CEPAT ALAT SEKOLAH -->
        <div class="row g-3">
            <div class="col-12 mb-2">
                <h5 class="fw-bold text-body m-0"><i class="bi bi-grid-fill text-primary me-2"></i>Kategori Peralatan Populer</h5>
            </div>
            
            <div class="col-6 col-md-3">
                <a href="#" class="card border-0 bg-body-tertiary p-3 rounded-4 text-decoration-none text-body hover-lift d-flex flex-row align-items-center gap-3">
                    <div class="icon-box bg-danger-subtle text-danger rounded-3">
                        <i class="bi bi-projector fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Multimedia</h6>
                        <small class="text-secondary">Proyektor, Layar</small>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="card border-0 bg-body-tertiary p-3 rounded-4 text-decoration-none text-body hover-lift d-flex flex-row align-items-center gap-3">
                    <div class="icon-box bg-info-subtle text-info rounded-3">
                    <i class="bi bi-trash3-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Alat kebersihan</h6>
                        <small class="text-secondary">Penngki, Sapu dll</small>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="card border-0 bg-body-tertiary p-3 rounded-4 text-decoration-none text-body hover-lift d-flex flex-row align-items-center gap-3">
                    <div class="icon-box bg-success-subtle text-success rounded-3">
                        <i class="bi bi-dribbble fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Olahraga</h6>
                        <small class="text-secondary">Bola, Matras, Net</small>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="card border-0 bg-body-tertiary p-3 rounded-4 text-decoration-none text-body hover-lift d-flex flex-row align-items-center gap-3">
                    <div class="icon-box bg-warning-subtle text-warning rounded-3">
                        <i class="bi bi-music-note-beamed fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Kesenian</h6>
                        <small class="text-secondary">Gitar, Sound System</small>
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
            
            if (theme === 'dark') {
                themeIcon.classList.replace('bi-moon-stars-fill', 'bi-sun-fill');
            } else {
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