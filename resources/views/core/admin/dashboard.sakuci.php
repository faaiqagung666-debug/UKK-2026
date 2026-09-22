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

        @media (prefers-color-scheme: dark) {
            .card-brand, .menu-card { background: #1f1f23; }
        }
        [data-bs-theme="dark"] .card-brand,
        [data-bs-theme="dark"] .menu-card {
            background: #1f1f23;
        }
    </style>

    <div class="card card-brand mb-4">
        <div class="card-body p-4">
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">Area Admin</span>
            <h1 class="h4 mb-2">Halo, {{ $user->username }}</h1>
            <p class="text-secondary mb-0">Halaman ini hanya bisa diakses role <code class="inline">admin</code> (middleware <code class="inline">admin</code>).</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <a href="{{ route('admin.roles.index') }}" class="card menu-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="menu-icon">👤</div>
                    <h2 class="h6 mb-1">Manage Role</h2>
                    <p class="text-secondary small mb-0">Tambah role baru untuk dipakai saat membuat user.</p>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.users.index') }}" class="card menu-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="menu-icon">👥</div>
                    <h2 class="h6 mb-1">Manage User</h2>
                    <p class="text-secondary small mb-0">Tambah user baru dan tentukan role-nya.</p>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.database.export') }}" class="card menu-card text-decoration-none h-100">
                <div class="card-body p-4">
                    <div class="menu-icon">💾</div>
                    <h2 class="h6 mb-1">Download Database</h2>
                    <p class="text-secondary small mb-0">Unduh seluruh isi database jadi satu file .sql, siap diimpor di server.</p>
                </div>
            </a>
        </div>
    </div>

@endsection