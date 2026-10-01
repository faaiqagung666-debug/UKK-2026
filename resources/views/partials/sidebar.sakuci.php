@php
    $dbConnected = false;
    try {
        \Sakuci\Database\Connection::pdo();
        $dbConnected = true;
    } catch (\Throwable $e) {
        $dbConnected = false;
    }
    $currentUser = \App\Models\User::current();
    
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

<!-- OFFCANVAS SIDEBAR -->
<div class="offcanvas offcanvas-start sidebar-brand border-end shadow" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel" style="width: 280px;">
    
    <div class="offcanvas-header sidebar-header border-bottom px-4 py-3">
        <div class="d-flex align-items-center gap-2">
            <div class="brand-icon d-flex align-items-center justify-content-center">
                <i class="bi bi-box-seam-fill fs-6"></i>
            </div>

            <h6 class="offcanvas-title fw-bold text-body m-0" id="sidebarMenuLabel">
                {{ config('app.name') }}
            </h6>
        </div>

        <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-3 d-flex flex-column">

        <div class="sidebar-title text-uppercase fw-bold fs-9 tracking-wider mb-2 px-2">
            Menu Navigasi
        </div>

        <ul class="nav nav-pills flex-column mb-auto gap-1">

            <!-- BERANDA -->
            <li class="nav-item">
                <a
                    class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('home') ? 'active' : 'text-body' }}"
                    href="{{ route('home') }}"
                >
                    <i class="bi bi-house-door fs-5"></i>
                    <span class="fw-medium">Beranda</span>
                </a>
            </li>

            @if ($currentUser)

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <a
                        class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('admin.dashboard', 'dashboard', 'petugas.dashboard', 'peminjam.dashboard') ? 'active' : 'text-body' }}"
                        href="{{ 
                            $currentUser->role === 'admin' ? route('admin.dashboard') : 
                            ($currentUser->role === 'petugas' ? route('petugas.dashboard') : route('peminjam.dashboard')) 
                        }}"
                    >
                        <i class="bi bi-speedometer2 fs-5"></i>
                        <span class="fw-medium">Dashboard</span>
                    </a>
                </li>

                {{-- MENU KHUSUS ADMIN --}}
                @if ($currentUser->role === 'admin')

                    <li class="nav-item">
                        <a
                            class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('alat.index') ? 'active' : 'text-body' }}"
                            href="{{ route('alat.index') }}"
                        >
                            <i class="bi bi-tools fs-5"></i>
                            <span class="fw-medium">Kelola Alat</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('kategori.index') ? 'active' : 'text-body' }}"
                            href="{{ route('kategori.index') }}"
                        >
                            <i class="bi bi-tags fs-5"></i>
                            <span class="fw-medium">Kategori Alat</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('peminjaman.index') ? 'active' : 'text-body' }}"
                            href="{{ route('peminjaman.index') }}"
                        >
                            <i class="bi bi-box-arrow-up-right fs-5"></i>
                            <span class="fw-medium">Peminjaman Alat</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('pengembalian.index') ? 'active' : 'text-body' }}"
                            href="{{ route('pengembalian.index') }}"
                        >
                            <i class="bi bi-arrow-return-left fs-5"></i>
                            <span class="fw-medium">Pengembalian Alat</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('admin.logs.index') ? 'active' : 'text-body' }}"
                            href="{{ route('admin.logs.index') }}"
                        >
                            <i class="bi bi-clock-history fs-5"></i>
                            <span class="fw-medium">Log Aktivitas</span>
                        </a>
                    </li>

                @endif

                {{-- MENU KHUSUS PETUGAS --}}
                @if ($currentUser->role === 'petugas')

                    <li class="nav-item">
                        <a
                            class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('petugas.peminjaman.index') ? 'active' : 'text-body' }}"
                            href="{{ route('petugas.peminjaman.index') }}"
                        >
                            <i class="bi bi-check2-square fs-5"></i>
                            <span class="fw-medium">Persetujuan Peminjaman</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('petugas.pengembalian.index') ? 'active' : 'text-body' }}"
                            href="{{ route('petugas.pengembalian.index') }}"
                        >
                            <i class="bi bi-arrow-return-left fs-5"></i>
                            <span class="fw-medium">Pantau Pengembalian</span>
                        </a>
                    </li>

                @endif

                {{-- MENU KHUSUS PEMINJAM (Siswa) --}}
                @if ($currentUser->role === 'peminjam')

                    <li class="nav-item">
                        <a
                            class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('peminjam.alat') ? 'active' : 'text-body' }}"
                            href="{{ route('peminjam.alat') }}"
                        >
                            <i class="bi bi-grid fs-5"></i>
                            <span class="fw-medium">Katalog Alat</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('peminjam.riwayat', 'peminjam.indexPeminjam') ? 'active' : 'text-body' }}"
                            href="{{ route('peminjam.riwayat') }}"
                        >
                            <i class="bi bi-clock-history fs-5"></i>
                            <span class="fw-medium">Riwayat Peminjaman</span>
                        </a>
                    </li>

                    <!-- Tambahan Menu Pengembalian Alat untuk Peminjam -->
                    <li class="nav-item">
                        <a
                            class="nav-link sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ is_route('peminjam.riwayat') ? 'active' : 'text-body' }}"
                            href="{{ route('peminjam.pengembalian') }}"
                        >
                            <i class="bi bi-arrow-return-left fs-5"></i>
                            <span class="fw-medium">Pengembalian Alat</span>
                        </a>
                    </li>

                @endif

            @endif
        </ul>

        <hr class="opacity-25 my-3">

        <div class="mt-auto">

            @if ($currentUser)

                <div class="user-box rounded-3 p-3 mb-2 d-flex flex-column gap-1">
                    <span class="fw-bold text-body fs-8 leading-tight">
                        {{ $currentUser->username }}
                    </span>

                    <span class="text-body-secondary fs-9 text-capitalize">
                        {{ $currentUser->role ?? 'Siswa/Guru' }}
                    </span>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-outline-danger fw-semibold w-100 py-2 rounded-3 d-flex align-items-center justify-content-center gap-2"
                    >
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>

            @else

                <a
                    class="btn btn-brand fw-semibold w-100 rounded-3 py-2"
                    href="{{ route('login') }}"
                >
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    Masuk
                </a>

            @endif

        </div>
    </div>
</div>

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-soft: #eaf8f1;
        --brand-border: rgba(13, 122, 80, 0.14);
    }

    .sidebar-brand {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bs-body-bg) !important;
        border-color: var(--brand-border) !important;
    }

    .sidebar-header {
        background: linear-gradient(
            135deg,
            rgba(6, 78, 59, 0.07),
            rgba(13, 122, 80, 0.04)
        );
    }

    .brand-icon {
        width: 32px;
        height: 32px;
        border-radius: .65rem;
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
        color: #fff;
        box-shadow: 0 5px 12px rgba(13, 122, 80, .20);
        transition: all .25s ease;
    }

    .brand-icon:hover {
        transform: rotate(-4deg) scale(1.06);
        box-shadow: 0 8px 17px rgba(13, 122, 80, .28);
    }

    .sidebar-title {
        color: var(--bs-secondary-color);
    }

    .sidebar-link {
        position: relative;
        overflow: hidden;
        min-height: 42px;
        transition:
            background-color .22s ease,
            color .22s ease,
            transform .22s ease,
            box-shadow .22s ease;
    }

    .sidebar-link::before {
        content: "";
        position: absolute;
        left: 0;
        top: 7px;
        bottom: 7px;
        width: 3px;
        border-radius: 0 5px 5px 0;
        background: var(--whistle);
        transform: scaleY(0);
        transition: transform .22s ease;
    }

    .sidebar-link:hover:not(.active) {
        background-color: var(--bs-secondary-bg);
        color: var(--brand-1) !important;
        transform: translateX(3px);
    }

    .sidebar-link:hover:not(.active)::before {
        transform: scaleY(.65);
    }

    .sidebar-link.active {
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        ) !important;
        color: #fff !important;
        box-shadow: 0 6px 14px rgba(13, 122, 80, .20);
    }

    .sidebar-link.active::before {
        transform: scaleY(1);
    }

    .sidebar-link.active i {
        color: var(--whistle);
    }

    .sidebar-link i {
        width: 22px;
        text-align: center;
        transition:
            transform .22s ease,
            color .22s ease;
    }

    .sidebar-link:hover i {
        transform: scale(1.08);
    }

    .user-box {
        background: var(--bs-secondary-bg);
        border: 1px solid var(--brand-border);
        transition:
            border-color .2s ease,
            transform .2s ease;
    }

    .user-box:hover {
        border-color: rgba(13, 122, 80, .30);
        transform: translateY(-1px);
    }

    .btn-brand {
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
        border: 0;
        color: #fff;
        transition: all .25s ease;
    }

    .btn-brand:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 7px 16px rgba(13, 122, 80, .25);
    }

    .sidebar-brand .btn-outline-danger {
        transition: all .22s ease;
    }

    .sidebar-brand .btn-outline-danger:hover {
        transform: translateY(-1px);
    }

    .fs-8 {
        font-size: 0.85rem;
    }

    .fs-9 {
        font-size: 0.75rem;
    }

    .tracking-wider {
        letter-spacing: .08em;
    }

    .leading-tight {
        line-height: 1.2;
    }

    /* Scrollbar */
    .sidebar-brand .offcanvas-body::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-brand .offcanvas-body::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-brand .offcanvas-body::-webkit-scrollbar-thumb {
        background: rgba(13, 122, 80, .25);
        border-radius: 10px;
    }

    .sidebar-brand .offcanvas-body::-webkit-scrollbar-thumb:hover {
        background: rgba(13, 122, 80, .45);
    }

    /* Dark Mode */
    [data-bs-theme="dark"] .sidebar-header {
        background: linear-gradient(
            135deg,
            rgba(6, 78, 59, .18),
            rgba(13, 122, 80, .10)
        );
    }

    [data-bs-theme="dark"] .sidebar-link:hover:not(.active) {
        background-color: var(--bs-secondary-bg);
        color: #72d7ad !important;
    }

    [data-bs-theme="dark"] .user-box {
        border-color: rgba(255, 255, 255, .08);
    }

    [data-bs-theme="dark"] .sidebar-brand .offcanvas-body::-webkit-scrollbar-thumb {
        background: rgba(95, 214, 165, .30);
    }
</style>