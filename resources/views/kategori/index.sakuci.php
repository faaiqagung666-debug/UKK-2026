@extends('layouts.app')

@section('title', config('app.name') . ' -- Manajemen Kategori Alat')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-soft: #eaf8f1;
        --brand-border: rgba(13, 122, 80, 0.14);

        --hero-bg-light:
            radial-gradient(circle at 15% 15%, rgba(13, 122, 80, .28), transparent 35%),
            radial-gradient(circle at 85% 85%, rgba(217, 242, 75, .10), transparent 35%),
            linear-gradient(135deg, #163d34 0%, #26322f 100%);

        --hero-bg-dark:
            radial-gradient(circle at 15% 15%, rgba(13, 122, 80, .32), transparent 35%),
            radial-gradient(circle at 85% 85%, rgba(217, 242, 75, .09), transparent 35%),
            linear-gradient(135deg, #102f28 0%, #242c2a 100%);
    }

    /* ================================
       HERO
    ================================= */
    .hero-wrap {
        position: relative;
        overflow: hidden;
        border-radius: 1.5rem;
        padding: 2.5rem 1.5rem;
        background: var(--hero-bg-light) !important;
        border: 1px solid rgba(255, 255, 255, .10) !important;
        box-shadow: 0 10px 30px rgba(6, 78, 59, .10);
        transition:
            background .3s ease,
            border-color .3s ease,
            box-shadow .3s ease;
    }

    .hero-wrap::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        top: -120px;
        right: -60px;
        background: rgba(217, 242, 75, .07);
        pointer-events: none;
    }

    .hero-wrap::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        bottom: -110px;
        left: -50px;
        background: rgba(13, 122, 80, .14);
        pointer-events: none;
    }

    .hero-wrap > * {
        position: relative;
        z-index: 2;
    }

    .hero-wrap h1 {
        color: #f8fafc !important;
        letter-spacing: -.025em;
    }

    /*
     * Penting:
     * !important dipakai supaya .text-brand dari app.css
     * tidak berubah menjadi warna ungu/biru.
     */
    .hero-wrap .text-brand {
        color: var(--whistle) !important;
        background: none !important;
        -webkit-background-clip: initial !important;
        background-clip: initial !important;
        -webkit-text-fill-color: var(--whistle) !important;
    }

    .hero-wrap p {
        color: rgba(255, 255, 255, .70) !important;
        max-width: 560px;
        line-height: 1.65;
    }

    /* ================================
       BADGE HERO
    ================================= */
    .hero-wrap .badge-brand {
        display: inline-flex;
        align-items: center;
        background: var(--brand-1) !important;
        color: #fff !important;
        border: 1px solid rgba(255, 255, 255, .08);
        font-weight: 600;
        letter-spacing: .01em;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .12);
    }

    /* ================================
       BUTTON BRAND
    ================================= */
    .btn-brand {
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        ) !important;
        border: none !important;
        color: #fff !important;
        font-weight: 600;
        border-radius: .8rem;
        box-shadow: 0 7px 20px rgba(0, 0, 0, .14);
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            filter .18s ease;
    }

    .btn-brand:hover,
    .btn-brand:focus {
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 11px 26px rgba(0, 0, 0, .20);
        filter: brightness(1.05);
    }

    .btn-brand:active {
        transform: translateY(0);
    }

    /* ================================
       CARD
    ================================= */
    .card-brand {
        border: 1px solid var(--brand-border);
        border-radius: 1.2rem;
        background: var(--bs-body-bg);
        transition:
            background .3s ease,
            border-color .3s ease,
            box-shadow .3s ease;
    }

    .card-brand:hover {
        box-shadow: 0 12px 30px rgba(6, 78, 59, .07) !important;
    }

    /* ================================
       CARD HEADER
    ================================= */
    .category-card-header {
        background: transparent !important;
        border-bottom: 1px solid var(--bs-border-color) !important;
    }

    .category-header-icon {
        color: var(--brand-1) !important;
    }

    .category-card-title {
        color: var(--bs-body-color) !important;
        font-size: .95rem;
        font-weight: 700;
        margin: 0;
    }

    .category-total {
        background-color: var(--bs-tertiary-bg) !important;
        color: var(--bs-secondary-color) !important;
        border: 1px solid var(--bs-border-color) !important;
        font-size: .8rem;
        font-weight: 400 !important;
    }

    /* ================================
       CATEGORY CODE
    ================================= */
    code.inline {
        background: rgba(13, 122, 80, .09);
        color: var(--brand-1);
        padding: .25rem .6rem;
        border-radius: .5rem;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid rgba(13, 122, 80, .18);
        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease;
    }

    tr:hover code.inline {
        background: rgba(217, 242, 75, .28);
        color: var(--brand-2);
        border-color: rgba(13, 122, 80, .22);
    }

    /* ================================
       TABLE
    ================================= */
    .table {
        --bs-table-hover-bg: rgba(13, 122, 80, .035);
    }

    .table tbody tr {
        transition:
            background-color .2s ease,
            transform .2s ease;
    }

    .table tbody tr:hover {
        box-shadow: inset 4px 0 0 var(--brand-1);
    }

    .table thead th {
        letter-spacing: .06em;
        font-size: .72rem;
    }

    /* ================================
       EDIT BUTTON
    ================================= */
    .btn-outline-warning {
        transition:
            transform .18s ease,
            background-color .18s ease,
            color .18s ease;
    }

    .btn-outline-warning:hover {
        transform: translateY(-1px);
    }

    /* ================================
       DELETE BUTTON
    ================================= */
    .btn-outline-danger {
        transition:
            transform .18s ease,
            background-color .18s ease,
            color .18s ease;
    }

    .btn-outline-danger:hover {
        transform: translateY(-1px);
    }

    /* ================================
       EMPTY STATE
    ================================= */
    .empty-category {
        animation: fadeUp .45s ease both;
    }

    .empty-category-icon {
        transition:
            transform .25s ease,
            background-color .25s ease;
    }

    .empty-category:hover .empty-category-icon {
        transform: translateY(-3px);
    }

    /* ================================
       DARK MODE
    ================================= */
    [data-bs-theme="dark"] .hero-wrap {
        background: var(--hero-bg-dark) !important;
        border-color: rgba(255, 255, 255, .10) !important;
    }

    [data-bs-theme="dark"] .hero-wrap h1 {
        color: #f8fafc !important;
    }

    [data-bs-theme="dark"] .hero-wrap .text-brand {
        color: var(--whistle) !important;
        background: none !important;
        -webkit-background-clip: initial !important;
        background-clip: initial !important;
        -webkit-text-fill-color: var(--whistle) !important;
    }

    [data-bs-theme="dark"] .hero-wrap p {
        color: rgba(255, 255, 255, .68) !important;
    }

    [data-bs-theme="dark"] .card-brand {
        border-color: rgba(255, 255, 255, .08);
    }

    [data-bs-theme="dark"] .category-card-header {
        background: transparent !important;
        border-bottom-color: rgba(255, 255, 255, .08) !important;
    }

    [data-bs-theme="dark"] .category-header-icon {
        color: #5fd6a5 !important;
    }

    [data-bs-theme="dark"] .category-card-title {
        color: #f8fafc !important;
    }

    [data-bs-theme="dark"] .category-total {
        background-color: rgba(255, 255, 255, .06) !important;
        color: #adb5bd !important;
        border-color: rgba(255, 255, 255, .10) !important;
    }

    [data-bs-theme="dark"] code.inline {
        background: rgba(95, 214, 165, .12);
        color: #5fd6a5;
        border-color: rgba(95, 214, 165, .22);
    }

    [data-bs-theme="dark"] tr:hover code.inline {
        background: rgba(217, 242, 75, .14);
        color: var(--whistle);
        border-color: rgba(217, 242, 75, .22);
    }

    [data-bs-theme="dark"] .table {
        --bs-table-hover-bg: rgba(95, 214, 165, .05);
    }

    [data-bs-theme="dark"] .btn-brand {
        box-shadow: 0 7px 22px rgba(13, 122, 80, .35);
    }

    /* ================================
       ANIMATIONS
    ================================= */
    .hero-wrap {
        animation: heroIn .5s ease both;
    }

    .card-brand {
        animation: fadeUp .55s ease .08s both;
    }

    .badge-brand {
        animation: badgePulse 2.8s ease-in-out infinite;
    }

    @keyframes heroIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes badgePulse {
        0%,
        100% {
            box-shadow: 0 4px 18px rgba(13, 122, 80, .25);
        }

        50% {
            box-shadow: 0 6px 24px rgba(217, 242, 75, .20);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="container-fluid py-4 px-4">

    {{-- Alert Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4"
             role="alert">

            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>

                <div class="small fw-medium">
                    {{ session('success') }}
                </div>
            </div>

            <button type="button"
                    class="btn-close shadow-none"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif


    {{-- =========================================
         HERO SECTION
         Sama pola dengan Peminjaman / Pengembalian
    ========================================== --}}
    <section class="text-center hero-wrap mb-4 shadow-sm">

        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
            <i class="bi bi-tags-fill me-1"></i>
            Kategori Olahraga
        </span>

        <h1 class="display-6 fw-bold mb-2">
            Kategori
            <span class="text-brand">Peralatan Olahraga</span>
        </h1>

        <p class="mx-auto mb-4">
            Kelola pengelompokan jenis alat praktikum, olahraga.
        </p>

        <a href="{{ route('kategori.create') }}"
           class="btn btn-brand px-4 py-2 d-inline-flex align-items-center gap-2">

            <i class="bi bi-plus-circle-fill fs-6"></i>

            <span>Tambah Kategori Baru</span>

        </a>

    </section>


    {{-- Card Tabel --}}
    <div class="card card-brand shadow-sm overflow-hidden">

        {{-- Header Card --}}
        <div class="card-header category-card-header py-3 px-4 d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-folder-symlink category-header-icon fs-5"></i>

                <h6 class="category-card-title">
                    Daftar Kategori Terdaftar
                </h6>

            </div>

            <span class="badge category-total px-3 py-1.5 rounded-pill">
                Total: {{ count($kategori) }} Kategori
            </span>

        </div>


        {{-- Body Card --}}
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">

                        <tr>

                            <th class="py-3 px-4 text-center" style="width: 5%;">
                                No
                            </th>

                            <th class="py-3 px-3" style="width: 20%;">
                                Kode Kategori
                            </th>

                            <th class="py-3 px-3" style="width: 25%;">
                                Nama Kategori
                            </th>

                            <th class="py-3 px-3">
                                Keterangan
                            </th>

                            <th class="py-3 px-4 text-center" style="width: 180px;">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y">

                        @php
                            $no = 1;
                        @endphp

                        @forelse ($kategori as $item)

                            <tr>

                                <td class="px-4 text-center text-body-secondary fw-medium fs-7">
                                    {{ $no++ }}
                                </td>

                                <td class="px-3">

                                    <code class="inline">
                                        #{{ $item->kode_kategori }}
                                    </code>

                                </td>

                                <td class="px-3">

                                    <span class="fw-bold text-body fs-7">
                                        {{ $item->nama_kategori }}
                                    </span>

                                </td>

                                <td class="px-3">

                                    <span class="text-body-secondary fs-7">
                                        {{ $item->keterangan ?? '-' }}
                                    </span>

                                </td>

                                <td class="px-4 text-center">

                                    <div class="d-inline-flex align-items-center justify-content-center gap-1.5">

                                        <a href="{{ route('kategori.edit', ['id_kategori' => $item->id_kategori]) }}"
                                           class="btn btn-sm btn-outline-warning fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                           title="Edit Kategori">

                                            <i class="bi bi-pencil-square"></i>
                                            Edit

                                        </a>

                                        <form action="{{ route('kategori.destroy', ['id_kategori' => $item->id_kategori]) }}"
                                              method="POST"
                                              class="d-inline m-0">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')"
                                                    title="Hapus Kategori">

                                                <i class="bi bi-trash"></i>
                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center py-5 text-body-secondary">

                                    <div class="d-flex flex-column align-items-center gap-2 empty-category">

                                        <div class="bg-body-tertiary rounded-circle p-3 mb-1 empty-category-icon">

                                            <i class="bi bi-folder-x text-body-secondary fs-2 opacity-50"></i>

                                        </div>

                                        <h6 class="fw-bold mb-0 text-body">
                                            Belum Ada Kategori Peralatan
                                        </h6>

                                        <span class="fs-7 text-body-secondary">
                                            Silakan tambahkan kategori baru untuk mengelompokkan barang sarpras.
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Pagination --}}
        @if(method_exists($kategori, 'hasPages') && $kategori->hasPages())

            <div class="card-footer bg-transparent py-3 border-top d-flex justify-content-end">

                {!! $kategori->links() !!}

            </div>

        @endif

    </div>

</div>
@endsection