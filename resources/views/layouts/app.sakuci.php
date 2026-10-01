<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    {{-- Terapkan tema tersimpan sebelum komponen dirender --}}
    <script>
        (function () {
            var saved = localStorage.getItem('sakuci-theme');
            var theme = saved || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>

    {{-- Bootstrap 5.3 & Icons --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Font Tema --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,600;12..96,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-1: #0d7a50;
            --brand-2: #064e3b;
            --whistle: #d9f24b;
            --brand-soft: #eaf8f1;
            --brand-border: rgba(13, 122, 80, 0.14);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.01em;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .navbar-brand {
            font-family: 'Bricolage Grotesque', sans-serif;
        }

        .tracking-tight {
            letter-spacing: -0.025em;
        }

        .leading-tight {
            line-height: 1.15;
        }

        /* =========================================
           HEADER NAVBAR
        ========================================= */
        .main-navbar {
            transition:
                background-color .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        header.navbar {
            border-bottom-color: var(--brand-border) !important;
            transition:
                border-color .25s ease,
                box-shadow .25s ease;
        }

        header.navbar:hover {
            box-shadow: 0 .35rem 1.2rem rgba(6, 78, 59, .08) !important;
        }

        /* =========================================
           HAMBURGER BUTTON
        ========================================= */
        .navbar-menu-btn {
            color: var(--brand-2);
            transition:
                color .2s ease,
                background-color .2s ease,
                transform .2s ease;
        }

        .navbar-menu-btn:hover {
            color: var(--brand-1);
            background-color: var(--brand-soft);
            transform: translateY(-1px);
        }

        /* =========================================
           LOGO
        ========================================= */
        .navbar-logo-icon {
            width: 34px;
            height: 34px;
            background: linear-gradient(
                135deg,
                var(--brand-1),
                var(--brand-2)
            ) !important;
            box-shadow: 0 5px 14px rgba(13, 122, 80, .22);
            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .navbar-brand:hover .navbar-logo-icon {
            transform: translateY(-2px) rotate(-2deg);
            box-shadow: 0 8px 18px rgba(13, 122, 80, .28);
        }

        .navbar-brand:hover .navbar-brand-name {
            color: var(--brand-1);
        }

        .navbar-brand-name {
            transition: color .2s ease;
        }

        /* =========================================
           THEME BUTTON
        ========================================= */
        .theme-toggle {
            color: var(--brand-2);
            border-color: var(--brand-border) !important;
            background: var(--bs-body-bg);
            transition:
                color .2s ease,
                background-color .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }

        .theme-toggle:hover {
            color: var(--brand-2);
            background-color: var(--whistle);
            border-color: var(--whistle) !important;
            transform: rotate(8deg) scale(1.04);
        }

        /* =========================================
           USER INFO
        ========================================= */
        .navbar-user-info {
            transition: transform .2s ease;
        }

        .navbar-user-info:hover {
            transform: translateX(-2px);
        }

        .navbar-user-role {
            color: var(--brand-1) !important;
            font-weight: 600;
        }

        /* =========================================
           LOGOUT
        ========================================= */
        .logout-btn {
            transition:
                transform .2s ease,
                background-color .2s ease,
                color .2s ease;
        }

        .logout-btn:hover {
            transform: translateY(-1px);
        }

        /* =========================================
           MAIN CONTENT
        ========================================= */
        main {
            animation: pageIn .4s ease both;
        }

        /* =========================================
           FOOTER
        ========================================= */
        footer.footer-brand {
            border-top-color: var(--brand-border) !important;
        }

        /* =========================================
           DARK MODE
        ========================================= */
        [data-bs-theme="dark"] header.navbar {
            background-color: var(--bs-body-bg) !important;
            border-bottom-color: rgba(217, 242, 75, .10) !important;
        }

        [data-bs-theme="dark"] .navbar-menu-btn {
            color: #d7e8df;
        }

        [data-bs-theme="dark"] .navbar-menu-btn:hover {
            color: var(--whistle);
            background-color: rgba(217, 242, 75, .08);
        }

        [data-bs-theme="dark"] .navbar-brand:hover .navbar-brand-name {
            color: #5fd6a5;
        }

        [data-bs-theme="dark"] .theme-toggle {
            color: #d9f24b;
            border-color: rgba(217, 242, 75, .18) !important;
            background: var(--bs-body-bg);
        }

        [data-bs-theme="dark"] .theme-toggle:hover {
            color: var(--brand-2);
            background-color: var(--whistle);
            border-color: var(--whistle) !important;
        }

        [data-bs-theme="dark"] .navbar-user-role {
            color: #5fd6a5 !important;
        }

        /* =========================================
           ANIMATIONS
        ========================================= */
        @keyframes pageIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body class="bg-body-tertiary d-flex flex-column min-vh-100">

    {{-- HEADER NAVBAR UTAMA --}}
    <header class="navbar bg-body-tertiary border-bottom sticky-top px-3 py-2 shadow-sm">
        <div class="container-fluid p-0 d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center gap-2">

                {{-- Tombol Hamburger (Bisa diklik di Laptop & HP) --}}
                <button class="btn btn-light border-0 shadow-none p-2 rounded-3 navbar-menu-btn"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu"
                        title="Buka Menu Navigasi">
                    <i class="bi bi-list fs-4"></i>
                </button>

                {{-- Logo Aplikasi --}}
                <a class="navbar-brand fw-bold m-0 d-flex align-items-center gap-2 text-body"
                   href="{{ route('home') }}">

                    <div class="navbar-logo-icon text-white rounded-3 p-1.5 d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-seam-fill fs-6"></i>
                    </div>

                    <span class="tracking-tight fs-6 navbar-brand-name">
                        {{ config('app.name') }}
                    </span>
                </a>
            </div>

            {{-- Sisi Kanan Navbar: Tombol Dark Mode & Info User --}}
            <div class="d-flex align-items-center gap-2">

                {{-- Tombol Dark / Light Mode (Tanpa script JS terpisah) --}}
                <button type="button"
                        class="btn btn-sm btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center theme-toggle"
                        style="width: 34px; height: 34px;"
                        title="Ganti Mode Gelap/Terang"
                        onclick="
                            const html = document.documentElement;
                            const newTheme = html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
                            html.setAttribute('data-bs-theme', newTheme);
                            localStorage.setItem('sakuci-theme', newTheme);
                        ">
                    <i class="bi bi-moon-stars-fill fs-6"></i>
                </button>

                @php $currentUser = \App\Models\User::current(); @endphp

                @if ($currentUser)

                    <div class="d-flex flex-column text-end me-1 d-none d-sm-flex navbar-user-info">
                        <span class="fw-bold text-body fs-8 leading-tight">
                            {{ $currentUser->username }}
                        </span>

                        <span class="navbar-user-role fs-9 text-capitalize">
                            {{ $currentUser->role ?? 'Siswa/Guru' }}
                        </span>
                    </div>

                    <form method="POST"
                          action="{{ route('logout') }}"
                          class="m-0">

                        @csrf

                        <button type="submit"
                                class="btn btn-sm btn-outline-danger px-2.5 py-1.5 rounded-3 logout-btn"
                                title="Logout">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>

                @endif
            </div>

        </div>
    </header>

    {{-- SIDEBAR OFFCANVAS (Bisa Buka-Tutup) --}}
    @include('partials.sidebar')

    {{-- AREA KONTEN UTAMA --}}
    <main class="container-fluid flex-grow-1 p-3 p-md-4 p-lg-5">
        @include('partials.flash')
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    @yield('scripts')

</body>
</html>