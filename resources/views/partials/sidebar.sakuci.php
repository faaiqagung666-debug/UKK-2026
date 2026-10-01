@php
    $dbConnected = false;
    try {
        \Sakuci\Database\Connection::pdo();
        $dbConnected = true;
    } catch (\Throwable $e) {
        $dbConnected = false;
    }
    $currentUser = \App\Models\User::current();
    
    // Tentukan prefix/role rute aktif berdasarkan role user
    $rolePrefix = '';
    if ($currentUser) {
        if ($currentUser->role === 'admin') {
            $rolePrefix = 'admin.';
        } elseif ($currentUser->role === 'petugas') {
            $rolePrefix = 'petugas.';
        } else {
            $rolePrefix = 'peminjam.';
        }
    }
@endphp

<!-- OFFCANVAS SIDEBAR (Bisa dibuka & ditutup di semua layar) -->
<div class="offcanvas offcanvas-start bg-body-tertiary border-end shadow" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel" style="width: 280px;">
    
    <!-- Header Sidebar (Judul & Tombol Silang Tutup) -->
    <div class="offcanvas-header border-bottom px-4 py-3">
        <div class="d-flex align-items-center gap-2">
            <div class="bg-primary text-white rounded-3 p-1.5 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                <i class="bi bi-box-seam-fill fs-6"></i>
            </div>
            <h6 class="offcanvas-title fw-bold text-body m-0" id="sidebarMenuLabel">
                {{ config('app.name') }}
            </h6>
        </div>
        <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>


    <!-- Body Sidebar (Menu Navigasi Utama) -->
    <div class="offcanvas-body p-3 d-flex flex-column">
        <div class="text-uppercase text-body-tertiary fw-bold fs-9 tracking-wider mb-2 px-2">
            Menu Navigasi
        </div>

        <ul class="nav nav-pills flex-column mb-auto gap-1">
            <!-- Link Beranda -->
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('home') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}" href="{{ route('home') }}">
                    <i class="bi bi-house-door fs-5"></i>
                    <span class="fw-medium">Beranda</span>
                </a>
            </li>

            @if ($currentUser)
                <!-- Link Dashboard -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('admin.dashboard', 'dashboard', 'petugas.dashboard', 'peminjam.dashboard') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}"
                        href="{{ 
                            $currentUser->role === 'admin' ? route('admin.dashboard') : 
                            ($currentUser->role === 'petugas' ? route('petugas.dashboard') : route('peminjam.dashboard')) 
                        }}">
                        <i class="bi bi-speedometer2 fs-5"></i>
                        <span class="fw-medium">Dashboard</span>
                    </a>
                </li>

                {{-- MENU KHUSUS ADMIN & PETUGAS --}}
                @if (in_array($currentUser->role, ['admin', 'petugas']))
                    <!-- Link Data Alat (Admin) -->
                    @if($currentUser->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('alat.index') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}" 
                            href="{{ route('alat.index') }}">
                            <i class="bi bi-tools fs-5"></i>
                            <span class="fw-medium">Kelola Alat</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('kategori.index') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}" 
                            href="{{ route('kategori.index') }}">
                            <i class="bi bi-tags fs-5"></i>
                            <span class="fw-medium">Kategori Alat</span>
                        </a>
                    </li>
                    @endif

                    <!-- Link Peminjaman -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('peminjaman.index', 'petugas.peminjaman.index') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}" 
                            href="{{ route($currentUser->role === 'admin' ? 'peminjaman.index' : 'petugas.peminjaman.index') }}">
                            <i class="bi bi-box-arrow-up-right fs-5"></i>
                            <span class="fw-medium">Peminjaman Alat</span>
                        </a>
                    </li>

                    <!-- Link Pengembalian -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('pengembalian.index', 'petugas.pengembalian.index') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}" 
                            href="{{ route($currentUser->role === 'admin' ? 'pengembalian.index' : 'petugas.pengembalian.index') }}">
                            <i class="bi bi-arrow-return-left fs-5"></i>
                            <span class="fw-medium">Pengembalian Alat</span>
                        </a>
                    </li>

                    <!-- Link Log Aktivitas (Khusus Admin) -->
                    @if($currentUser->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('admin.logs.index') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}" 
                            href="{{ route('admin.logs.index') }}">
                            <i class="bi bi-clock-history fs-5"></i>
                            <span class="fw-medium">Log Aktivitas</span>
                        </a>
                    </li>
                    @endif
                @endif

                {{-- MENU KHUSUS PEMINJAM --}}
                @if ($currentUser->role === 'peminjam')
                    <!-- Link Katalog Alat -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('peminjam.alat') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}" 
                            href="{{ route('peminjam.alat') }}">
                            <i class="bi bi-grid fs-5"></i>
                            <span class="fw-medium">Katalog Alat</span>
                        </a>
                    </li>

                    <!-- Link Riwayat / Pengajuan Peminjaman -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('peminjam.riwayat', 'peminjam.indexPeminjam') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}" 
                            href="{{ route('peminjam.riwayat') }}">
                            <i class="bi bi-clock-history fs-5"></i>
                            <span class="fw-medium">Riwayat Peminjaman</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>

        <hr class="opacity-25 my-3">

        <!-- Footer Sidebar (Detail Akun / Logout) -->
        <div class="mt-auto">
            @if ($currentUser)
                <div class="bg-body-secondary rounded-3 p-3 mb-2 d-flex flex-column gap-1">
                    <span class="fw-bold text-body fs-8 leading-tight">{{ $currentUser->username }}</span>
                    <span class="text-body-secondary fs-9 text-capitalize">{{ $currentUser->role ?? 'Siswa/Guru' }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger fw-semibold w-100 py-2 rounded-3 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            @else
                <a class="btn btn-primary fw-semibold w-100 rounded-3 py-2" href="{{ route('login') }}">
                    Masuk
                </a>
            @endif
        </div>
    </div>
</div>

<style>
    .hover-bg-body-secondary:hover:not(.active) {
        background-color: var(--bs-secondary-bg);
    }
    .fs-8 { font-size: 0.85rem; }
    .fs-9 { font-size: 0.75rem; }
</style>