@extends('layouts.app')

@section('title', 'Daftar Alat Tersedia')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,600;12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.20);
        --brand-border: rgba(13, 122, 80, 0.18);
    }

    /* =========================
       BASE
    ========================= */
    .daftar-alat-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .daftar-alat-page h1,
    .daftar-alat-page h2,
    .daftar-alat-page h3,
    .daftar-alat-page h4,
    .daftar-alat-page h5,
    .daftar-alat-page h6 {
        font-family: 'Bricolage Grotesque', sans-serif;
    }

    /* =========================
       HEADER
    ========================= */
    .daftar-alat-header {
        animation: fadeUp .55s ease both;
    }

    .daftar-alat-header h3 {
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    /* =========================
       SEARCH
    ========================= */
    .search-alat .form-control {
        border-radius: .75rem 0 0 .75rem;
        border-color: var(--brand-border);
        box-shadow: none;
    }

    .search-alat .form-control:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem rgba(13, 122, 80, 0.10);
    }

    .btn-brand-action {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        border: none;
        color: #ffffff;
        box-shadow: 0 4px 14px var(--brand-glow);
        transition: all 0.2s ease;
        font-weight: 700;
    }

    .btn-brand-action:hover {
        background: linear-gradient(135deg, var(--brand-2), var(--brand-1));
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 7px 18px rgba(13, 122, 80, 0.25);
    }

    /* =========================
       CARD ALAT
    ========================= */
    .alat-card {
        border: 1px solid var(--brand-border);
        border-radius: 1.25rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.025);
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        color: inherit;
        background: var(--bs-body-bg);
        position: relative;
        overflow: hidden;
        animation: fadeUp .55s ease both;
    }

    .alat-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
        background: var(--brand-1);
        transform: scaleY(0);
        transform-origin: bottom;
        transition: transform .3s ease;
        z-index: 2;
    }

    .alat-card::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--whistle)
        );
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .alat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 30px rgba(13, 122, 80, 0.11);
        border-color: rgba(13, 122, 80, 0.32);
    }

    .alat-card:hover::before {
        transform: scaleY(1);
    }

    .alat-card:hover::after {
        opacity: 1;
    }

    /* =========================
       BADGE
    ========================= */
    .alat-card .badge {
        border-color: var(--brand-border) !important;
        transition: all .2s ease;
    }

    .alat-card:hover .badge {
        border-color: rgba(13, 122, 80, 0.25) !important;
    }

    /* =========================
       CARD TITLE
    ========================= */
    .alat-card h5 {
        font-weight: 800;
        letter-spacing: -0.015em;
    }

    /* =========================
       CARD FOOTER
    ========================= */
    .alat-card .border-top {
        border-color: rgba(127, 127, 127, 0.12) !important;
    }

    .alat-card:hover .border-top {
        border-color: rgba(13, 122, 80, 0.16) !important;
    }

    /* =========================
       EMPTY STATE
    ========================= */
    .alat-empty {
        animation: fadeUp .55s ease both;
    }

    /* =========================
       DARK MODE
    ========================= */
    [data-bs-theme="dark"] .alat-card {
        border-color: rgba(255, 255, 255, 0.08) !important;
        background: rgba(255, 255, 255, 0.02);
    }

    [data-bs-theme="dark"] .alat-card:hover {
        border-color: rgba(217, 242, 75, 0.22) !important;
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.25);
    }

    [data-bs-theme="dark"] .search-alat .form-control {
        border-color: rgba(255, 255, 255, 0.10);
    }

    [data-bs-theme="dark"] .alat-card .border-top {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }

    /* =========================
       ANIMATION
    ========================= */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .daftar-alat-header h3 {
            font-size: 1.35rem;
        }

        .alat-card {
            border-radius: 1.1rem;
        }
    }
</style>

<div class="container-fluid py-4 px-4 daftar-alat-page">

    <!-- Header & Fitur Pencarian -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 daftar-alat-header">
        <div>
            <h3 class="fw-bold mb-1 text-body">Daftar Alat Tersedia</h3>
            <p class="text-body-secondary mb-0">Pilih alat yang ingin Anda ajukan untuk dipinjam.</p>
        </div>

        <!-- Form Pencarian -->
        <form action="{{ route('peminjam.alat') }}" method="GET" class="d-flex gap-2 search-alat" style="max-width: 320px;">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Cari nama / kode alat..." value="{{ request('q') }}">
                <button class="btn btn-brand-action" type="submit">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Grid Card Daftar Alat -->
    <div class="row g-4">
        @forelse($alats as $item)
            @php
                $namaKategori = $kategoriMap[$item->id_kategori] ?? 'Umum';
            @endphp

            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card alat-card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between p-4">

                        <div>
                            <!-- Badge Kode Alat & Kategori -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-body-secondary text-body border px-2.5 py-1.5 fw-semibold" style="font-size: 0.75rem;">
                                    {{ $item->kode_alat }}
                                </span>

                                <span class="badge bg-body-secondary text-body border px-2.5 py-1.5 fw-semibold" style="font-size: 0.75rem;">
                                    {{ $namaKategori }}
                                </span>
                            </div>

                            <!-- Nama Alat -->
                            <h5 class="fw-bold fs-6 mb-2 text-body">
                                {{ $item->nama_alat }}
                            </h5>
                        </div>

                        <!-- Tombol Pinjam -->
                        <div class="mt-4 pt-3 border-top">
                            <a href="{{ route('peminjam.createPeminjam', ['id_alat' => $item->id_alat]) }}" 
                               class="btn btn-brand-action w-100 rounded-2 py-2 fw-medium d-flex align-items-center justify-content-center">
                                Ajukan Pinjam
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="card alat-card alat-empty border-0 shadow-sm p-5 text-center">
                    <h5 class="fw-bold text-body-secondary mb-0">
                        Belum ada alat yang tersedia.
                    </h5>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(method_exists($alats, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {!! $alats->links() !!}
        </div>
    @endif

</div>
@endsection