@extends('layouts.app')

@section('title', 'Admin')

@section('content')

    <style>
        :root {
            --brand-1: #4f8dff;
            --brand-2: #7c5cff;
        }

        .badge-brand {
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            color: #fff !important;
            font-weight: 600;
            letter-spacing: .03em;
            box-shadow: 0 4px 18px rgba(79,141,255,0.35);
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }
        .badge-brand::before {
            content: "🛡️";
            font-size: .9rem;
        }

        code.inline {
            background: rgba(127,127,127,0.12);
            padding: .2rem .55rem;
            border-radius: .5rem;
            font-size: .8rem;
            border: 1px solid rgba(127,127,127,0.18);
        }

        .card-brand {
            border: none;
            border-radius: 1.2rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        }

        .menu-card {
            border: none;
            border-radius: 1.2rem;
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
            transition: transform .18s ease, box-shadow .18s ease;
            color: inherit;
        }
        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 26px rgba(79,141,255,0.18);
        }
        .menu-icon {
            width: 44px;
            height: 44px;
            border-radius: .8rem;
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-bottom: .75rem;
        }

        /* Styling Tombol Titik Tiga yang Jelas */
        .btn-menu-toggle {
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            border: none;
            border-radius: 0.9rem;
            width: 48px;
            height: 44px;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(79,141,255,0.4);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-menu-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79,141,255,0.6);
            color: #ffffff;
        }

        /* Styling Sidebar Minimalis */
        .sidebar-nav .nav-link {
            color: #6c757d;
            border-radius: 0.8rem;
            padding: 0.7rem 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background: linear-gradient(135deg, rgba(79,141,255,0.12), rgba(124,92,255,0.12));
            color: var(--brand-1) !important;
        }

        @media (prefers-color-scheme: dark) {
            .card-brand, .menu-card, .offcanvas { background: #1f1f23; color: #fff; }
        }
        [data-bs-theme="dark"] .card-brand,
        [data-bs-theme="dark"] .menu-card,
        [data-bs-theme="dark"] .offcanvas {
            background: #1f1f23;
            color: #fff;
        }
    </style>

    <div class="container py-4">
        
        {{-- TOMBOL TITIK TIGA (Kini Lebih Jelas dengan Warna Brand & Bayangan) --}}
        <div class="mb-4">
            <button class="btn btn-menu-toggle d-flex align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar" aria-controls="adminSidebar" title="Buka Menu Admin">
                <span style="font-size: 1.6rem; line-height: 1; font-weight: bold; letter-spacing: 2px;">&#8942;</span>
            </button>
        </div>

        {{-- SIDEBAR OFFCANVAS --}}
        <div class="offcanvas offcanvas-start shadow" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
            <div class="offcanvas-header border-bottom pb-3 mb-3">
                <h5 class="offcanvas-title fw-bold text-primary" id="adminSidebarLabel">Menu Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body flex-column p-3">
                <div class="mb-4 px-2">
                    <span class="text-uppercase text-secondary fw-bold" style="font-size: 0.7rem; letter-spacing: .08em;">Panel Admin</span>
                    <div class="fw-bold fs-6 text-truncate">{{ $user->username }}</div>
                </div>

                <ul class="nav flex-column gap-1 sidebar-nav mb-4">
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}" class="nav-link d-flex align-items-center gap-2">
                            kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('alat.index') }}" class="nav-link d-flex align-items-center gap-2">
                            alat
                        </a>
                    </li>
                </ul>

                <div class="mt-auto pt-3 border-top px-2">
                    <p class="text-secondary small mb-0">
                        Masuk sebagai <code class="inline">admin</code>
                    </p>
                </div>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="row g-4">
            <div class="col-12">
                <div class="card card-brand mb-4">
                    <div class="card-body p-4">
                        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">Area Admin</span>
                        <h1 class="h4 mb-2">Halo, {{ $user->username }}</h1>
                        <p class="text-secondary mb-0">Halaman ini hanya bisa diakses role <code class="inline">admin</code> (middleware <code class="inline">admin</code>).</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="{{ route('admin.roles.index') }}" class="card menu-card text-decoration-none h-100">
                            <div class="card-body p-4">
                            <div class="menu-icon">👥</div>
                                <h2 class="h6 mb-1">tambah role</h2>
                                <p class="text-secondary small mb-0">Tambah role baru untuk dipakai saat membuat user.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.users.index') }}" class="card menu-card text-decoration-none h-100">
                            <div class="card-body p-4">
                                <div class="menu-icon">👥</div>
                                <h2 class="h6 mb-1">Manage User</h2>
                                <p class="text-secondary small mb-0">Tambah user baru dan tentukan role-nya.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.database.export') }}" class="card menu-card text-decoration-none h-100">
                            <div class="card-body p-4">
                                <div class="menu-icon">💾</div>
                                <h2 class="h6 mb-1">Download Database</h2>
                                <p class="text-secondary small mb-0">Unduh seluruh isi database jadi satu file .sql, siap diimpor di server.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection