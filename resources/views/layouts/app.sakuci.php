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
</head>
<body class="bg-body-tertiary d-flex flex-column min-vh-100">

    {{-- HEADER NAVBAR UTAMA --}}
    <header class="navbar bg-body-tertiary border-bottom sticky-top px-3 py-2 shadow-sm">
        <div class="container-fluid p-0 d-flex justify-content-between align-items-center">
            
            <div class="d-flex align-items-center gap-2">
                {{-- Tombol Hamburger (Bisa diklik di Laptop & HP) --}}
                <button class="btn btn-light border-0 shadow-none p-2 rounded-3" 
                        type="button" 
                        data-bs-toggle="offcanvas" 
                        data-bs-target="#sidebarMenu" 
                        aria-controls="sidebarMenu"
                        title="Buka Menu Navigasi">
                    <i class="bi bi-list fs-4"></i>
                </button>

                {{-- Logo Aplikasi --}}
                <a class="navbar-brand fw-bold m-0 d-flex align-items-center gap-2 text-body" href="{{ route('home') }}">
                    <div class="bg-primary text-white rounded-3 p-1.5 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                        <i class="bi bi-box-seam-fill fs-6"></i>
                    </div>
                    <span class="tracking-tight fs-6">{{ config('app.name') }}</span>
                </a>
            </div>

            {{-- Sisi Kanan Navbar: Tombol Dark Mode & Info User --}}
            <div class="d-flex align-items-center gap-2">
                
                {{-- Tombol Dark / Light Mode (Tanpa script JS terpisah) --}}
                <button type="button" 
                        class="btn btn-sm btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center" 
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
                    <div class="d-flex flex-column text-end me-1 d-none d-sm-flex">
                        <span class="fw-bold text-body fs-8 leading-tight">{{ $currentUser->username }}</span>
                        <span class="text-body-secondary fs-9 text-capitalize">{{ $currentUser->role ?? 'Siswa/Guru' }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger px-2.5 py-1.5 rounded-3" title="Logout">
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