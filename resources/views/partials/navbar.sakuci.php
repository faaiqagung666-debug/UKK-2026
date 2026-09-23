<nav class="navbar navbar-expand-lg bg-body border-bottom sticky-top navbar-brand-theme">
    <div class="container">
        <div class="d-flex align-items-center gap-2">
            @php
                $dbConnected = false;
                try {
                    \Sakuci\Database\Connection::pdo();
                    $dbConnected = true;
                } catch (\Throwable $e) {
                    $dbConnected = false;
                }
            @endphp
            <button id="themeToggle" type="button" class="logo-toggle"
                    aria-label="Ganti tema terang/gelap (status database: {{ $dbConnected ? 'terhubung' : 'tidak terhubung' }})"
                    title="Ganti tema terang/gelap">
                <svg width="28" height="28" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" style="display: block;" aria-hidden="true">
                    <circle class="logo-ring" cx="16" cy="16" r="15"/>
                    <circle cx="16" cy="16" r="9" fill="{{ $dbConnected ? '#28a745' : '#dc3545' }}"/>
                </svg>
            </button>
            <a class="navbar-brand fw-semibold m-0 text-brand-logo" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>

        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#menuUtama"
                aria-controls="menuUtama" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Tambahkan menu aplikasi Anda di sini --}}
        <div class="collapse navbar-collapse" id="menuUtama">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link {{ is_route('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ is_route('peminjaman.index') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">peminjaman</a>
                </li>
               
                @php
                    $currentUser = \App\Models\User::current();
                @endphp
                @if ($currentUser)
                    <li class="nav-item">
                        <a class="nav-link {{ is_route('admin.dashboard', 'dashboard') ? 'active' : '' }}"
                           href="{{ $currentUser->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-lg-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary w-100 mt-2 mt-lg-0">Logout ({{ $currentUser->username }})</button>
                        </form>
                    </li>
                @else
                    @php
                        $canRegister = false;
                        if ($dbConnected) {
                            try {
                                $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                            } catch (\Throwable $e) {
                                $canRegister = false;
                            }
                        }
                    @endphp
                    @if ($canRegister)
                        <li class="nav-item">
                            <a class="nav-link {{ is_route('register') ? 'active' : '' }}" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="btn btn-sm btn-brand rounded-pill px-3 d-inline-flex align-items-center gap-2 mt-2 mt-lg-0" href="{{ route('login') }}">
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="8" cy="5" r="3" fill="currentColor" stroke="none"/>
                                <path d="M2.5 14c0-3.6 2.9-5.8 5.5-5.8s5.5 2.2 5.5 5.8"/>
                            </svg>
                            Masuk
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<style>
    :root {
        --brand-1: #4f8dff;
        --brand-2: #7c5cff;
    }

    .navbar-brand-theme {
        backdrop-filter: blur(6px);
    }

    .text-brand-logo {
        font-size: 1.1rem;
    }

    .logo-toggle {
        background: none;
        border: none;
        padding: 0;
        line-height: 0;
        cursor: pointer;
        border-radius: 50%;
        transition: transform .18s ease;
    }
    .logo-toggle:hover {
        transform: scale(1.06);
    }
    .logo-toggle .logo-ring {
        fill: none;
        stroke: rgba(127,127,127,0.25);
        stroke-width: 1.5;
    }

    .navbar-brand-theme .nav-link {
        font-weight: 500;
        position: relative;
        color: inherit;
        opacity: .75;
        transition: opacity .15s ease, color .15s ease;
    }
    .navbar-brand-theme .nav-link:hover {
        opacity: 1;
    }
    .navbar-brand-theme .nav-link.active {
        opacity: 1;
        color: var(--brand-1) !important;
        font-weight: 700;
    }
    .navbar-brand-theme .nav-link.active::after {
        content: "";
        position: absolute;
        left: .25rem;
        right: .25rem;
        bottom: -4px;
        height: 3px;
        border-radius: 3px;
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
    }

    .btn-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        border: none;
        color: #fff;
        font-weight: 600;
        box-shadow: 0 6px 20px rgba(79,141,255,0.35);
        transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
    }
    .btn-brand:hover,
    .btn-brand:focus {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 26px rgba(79,141,255,0.45);
        filter: brightness(1.05);
    }
    .btn-brand:active {
        transform: translateY(0);
    }
</style>