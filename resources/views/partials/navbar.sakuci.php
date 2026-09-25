<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom sticky-top shadow-sm py-2.5">
    <div class="container">
        
        <!-- SISI KIRI: Logo, Brand & Switch Theme -->
        <div class="d-flex align-items-center gap-3">
            <!-- Tombol Theme Toggle Dark / Light -->
            <button id="themeToggleNavbar" type="button" 
                    class="btn btn-sm btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center shadow-2xs"
                    style="width: 36px; height: 36px;"
                    aria-label="Ganti tema terang/gelap"
                    title="Ubah Mode Tampilan">
                <!-- Ikon Bulan (Default Mode Light) -->
                <i class="bi bi-moon-stars-fill fs-6" id="themeNavbarIcon"></i>
            </button>

            <!-- Logo Brand Aplikasi Sarpras -->
            <a class="navbar-brand fw-bold m-0 d-flex align-items-center gap-2 text-body" href="{{ route('home') }}">
                <div class="bg-primary text-white rounded-3 p-1.5 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                    <i class="bi bi-box-seam-fill fs-6"></i>
                </div>
                <span class="tracking-tight fs-6">{{ config('app.name') }}</span>
            </a>
        </div>

        <!-- Tombol Toggler Seluler -->
        <button class="navbar-toggler border-0 p-1 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#menuUtama"
                aria-controls="menuUtama" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        @php
            $dbConnected = false;
            try {
                \Sakuci\Database\Connection::pdo();
                $dbConnected = true;
            } catch (\Throwable $e) {
                $dbConnected = false;
            }
        @endphp

        <!-- SISI KANAN: Navigasi Menu & Akun -->
        <div class="collapse navbar-collapse mt-3 mt-lg-0" id="menuUtama">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                
                <!-- Link Beranda -->
                <li class="nav-item">
                    <a class="nav-link fw-medium px-3 rounded-3 {{ is_route('home') ? 'active bg-primary-subtle text-primary' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i> Beranda
                    </a>
                </li>

                @php
                    $currentUser = \App\Models\User::current();
                @endphp

                @if ($currentUser)
                    <!-- Link Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link fw-medium px-3 rounded-3 {{ is_route('admin.dashboard', 'dashboard') ? 'active bg-primary-subtle text-primary' : '' }}"
                           href="{{ $currentUser->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>

                    <!-- Link Peminjaman Alat -->
                    <li class="nav-item">
                        <a class="nav-link fw-medium px-3 rounded-3 {{ is_route('peminjaman.index') ? 'active bg-primary-subtle text-primary' : '' }}" 
                           href="{{ route('peminjaman.index') }}">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Peminjaman
                        </a>
                    </li>

                    <!-- Link Pengembalian Alat -->
                    <li class="nav-item">
                        <a class="nav-link fw-medium px-3 rounded-3 {{ is_route('pengembalian.index') ? 'active bg-primary-subtle text-primary' : '' }}" 
                           href="{{ route('pengembalian.index') }}">
                            <i class="bi bi-arrow-return-left me-1"></i> Pengembalian
                        </a>
                    </li>

                    <!-- Separator Garis Tipis (Desktop) -->
                    <div class="vr d-none d-lg-block mx-1 my-2 text-body-secondary opacity-25"></div>

                    <!-- Tombol User & Logout -->
                    <li class="nav-item d-flex align-items-center gap-2 mt-2 mt-lg-0 ms-lg-1">
                        <div class="d-none d-xl-flex flex-column text-end">
                            <span class="fw-bold text-body fs-8 leading-tight">{{ $currentUser->username }}</span>
                            <span class="text-body-secondary fs-9 text-capitalize">{{ $currentUser->role ?? 'Siswa/Guru' }}</span>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger fw-semibold px-3 py-1.5 rounded-3 w-100 d-inline-flex align-items-center justify-content-center gap-1.5" title="Keluar Akun">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </button>
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
                            <a class="nav-link fw-medium px-3 rounded-3 {{ is_route('register') ? 'active bg-primary-subtle text-primary' : '' }}" href="{{ route('register') }}">
                                Daftar
                            </a>
                        </li>
                    @endif

                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-sm btn-primary fw-semibold rounded-pill px-3.5 py-1.5 d-inline-flex align-items-center justify-content-center gap-2 w-100 mt-2 mt-lg-0 shadow-sm" href="{{ route('login') }}">
                            <i class="bi bi-person-fill fs-6"></i>
                            <span>Masuk Akun</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>

<!-- Script Sinkronisasi Dark & Light Mode Navbar -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggleBtn = document.getElementById('themeToggleNavbar');
        const themeIcon = document.getElementById('themeNavbarIcon');
        const htmlElement = document.documentElement;

        const updateNavbarIcon = (theme) => {
            if (theme === 'dark') {
                themeIcon.className = 'bi bi-sun-fill text-warning fs-6';
            } else {
                themeIcon.className = 'bi bi-moon-stars-fill text-body fs-6';
            }
        };

        // Buka / Deteksi tema awal
        const currentTheme = htmlElement.getAttribute('data-bs-theme') || 
                             localStorage.getItem('theme') || 
                             (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        
        updateNavbarIcon(currentTheme);

        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => {
                const activeTheme = htmlElement.getAttribute('data-bs-theme');
                const newTheme = activeTheme === 'dark' ? 'light' : 'dark';
                
                htmlElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateNavbarIcon(newTheme);
            });
        }
    });
</script>