@php
    $dbConnected = false;
    try {
        \Sakuci\Database\Connection::pdo();
        $dbConnected = true;
    } catch (\Throwable $e) {
        $dbConnected = false;
    }
    $currentUser = \App\Models\User::current();
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
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('admin.dashboard', 'dashboard') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}"
                       href="{{ $currentUser->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                        <i class="bi bi-speedometer2 fs-5"></i>
                        <span class="fw-medium">Dashboard</span>
                    </a>
                </li>

                <!-- Link Peminjaman Alat -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('peminjaman.index') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}" 
                       href="{{ route('peminjaman.index') }}">
                        <i class="bi bi-box-arrow-up-right fs-5"></i>
                        <span class="fw-medium">Peminjaman Alat</span>
                    </a>
                </li>

                <!-- Link Pengembalian Alat -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ is_route('pengembalian.index') ? 'active bg-primary text-white' : 'text-body hover-bg-body-secondary' }}" 
                       href="{{ route('pengembalian.index') }}">
                        <i class="bi bi-arrow-return-left fs-5"></i>
                        <span class="fw-medium">Pengembalian Alat</span>
                    </a>
                </li>
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