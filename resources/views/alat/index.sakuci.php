@extends('layouts.app')

@section('title', config('app.name') . ' -- Manajemen Data Alat')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.22);

        --hero-bg-light:
            radial-gradient(
                circle at 15% 15%,
                rgba(13, 122, 80, .28),
                transparent 35%
            ),
            radial-gradient(
                circle at 85% 85%,
                rgba(217, 242, 75, .10),
                transparent 35%
            ),
            linear-gradient(
                135deg,
                #163d34 0%,
                #26322f 100%
            );

        --hero-bg-dark:
            radial-gradient(
                circle at 15% 15%,
                rgba(13, 122, 80, .32),
                transparent 35%
            ),
            radial-gradient(
                circle at 85% 85%,
                rgba(217, 242, 75, .09),
                transparent 35%
            ),
            linear-gradient(
                135deg,
                #102f28 0%,
                #242c2a 100%
            );
    }

    .alat-page {
        animation: fadeUp .45s ease both;
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
       SAMA DENGAN PEMINJAMAN
    ================================= */
    .hero-wrap .badge-brand {
        display: inline-flex;
        align-items: center;
        background: #0d7a50 !important;
        background-image: none !important;
        color: #fff !important;
        -webkit-text-fill-color: #fff !important;
        border: 1px solid rgba(255, 255, 255, .10) !important;
        font-weight: 600;
        letter-spacing: .01em;
        box-shadow: 0 5px 18px rgba(13, 122, 80, .25) !important;
    }

    .hero-wrap .badge-brand i {
        color: #fff !important;
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
        font-weight: 700;
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
        border: 1px solid rgba(127, 127, 127, .12);
        border-radius: 1.2rem;
        background: var(--bs-body-bg);
        overflow: hidden;
        transition:
            background .3s ease,
            border-color .3s ease,
            box-shadow .25s ease;
    }

    .card-brand:hover {
        box-shadow: 0 12px 32px rgba(6, 78, 59, .07) !important;
    }

    .card-header-brand {
        position: relative;
    }

    .card-header-brand::after {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 70px;
        height: 3px;
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--whistle)
        );
        border-radius: 0 3px 3px 0;
    }

    .inventory-icon {
        color: var(--brand-1);
    }

    .badge-kategori {
        display: inline-flex;
        align-items: center;
        background: rgba(13, 122, 80, .10);
        color: var(--brand-1);
        font-weight: 650;
        border-radius: .6rem;
        padding: .35rem .7rem;
        border: 1px solid rgba(13, 122, 80, .18);
    }

    code.inline {
        background: rgba(13, 122, 80, .09);
        color: var(--brand-1);
        padding: .25rem .6rem;
        border-radius: .5rem;
        font-size: .8rem;
        font-weight: 650;
        border: 1px solid rgba(13, 122, 80, .16);
    }

    .inventory-table {
        --bs-table-hover-bg: rgba(13, 122, 80, .035);
    }

    .inventory-table tbody tr {
        transition:
            background-color .18s ease,
            box-shadow .18s ease;
    }

    .inventory-table tbody tr:hover {
        box-shadow: inset 3px 0 0 var(--brand-1);
    }

    .inventory-table tbody td {
        vertical-align: middle;
    }

    /* ================================
       EDIT BUTTON
    ================================= */
    .btn-edit {
        border-color: rgba(13, 122, 80, .35);
        color: var(--brand-1);
        font-weight: 650;
    }

    .btn-edit:hover {
        background: var(--brand-1);
        border-color: var(--brand-1);
        color: #fff;
    }

    /* ================================
       EMPTY STATE
    ================================= */
    .empty-icon {
        width: 62px;
        height: 62px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(13, 122, 80, .07);
    }

    .alert-success {
        border-left: 4px solid var(--brand-1) !important;
    }

    /* ================================
       DARK MODE
    ================================= */
    [data-bs-theme="dark"] .hero-wrap {
        background: var(--hero-bg-dark) !important;
        border-color: rgba(255, 255, 255, .10) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .14);
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

    /*
     * Badge tetap hijau juga ketika dark mode.
     */
    [data-bs-theme="dark"] .hero-wrap .badge-brand {
        background: #0d7a50 !important;
        background-image: none !important;
        color: #fff !important;
        -webkit-text-fill-color: #fff !important;
        border-color: rgba(255, 255, 255, .10) !important;
        box-shadow: 0 5px 18px rgba(13, 122, 80, .30) !important;
    }

    [data-bs-theme="dark"] .hero-wrap .badge-brand i {
        color: #fff !important;
    }

    [data-bs-theme="dark"] .card-brand {
        border-color: rgba(255, 255, 255, .08);
    }

    [data-bs-theme="dark"] .badge-kategori {
        background: rgba(95, 214, 165, .10);
        color: #5fd6a5;
        border-color: rgba(95, 214, 165, .18);
    }

    [data-bs-theme="dark"] code.inline {
        background: rgba(95, 214, 165, .10);
        color: #5fd6a5;
        border-color: rgba(95, 214, 165, .18);
    }

    [data-bs-theme="dark"] .inventory-table {
        --bs-table-hover-bg: rgba(95, 214, 165, .045);
    }

    [data-bs-theme="dark"] .inventory-icon {
        color: #5fd6a5 !important;
    }

    [data-bs-theme="dark"] .btn-edit {
        border-color: rgba(95, 214, 165, .35);
        color: #5fd6a5;
    }

    [data-bs-theme="dark"] .btn-edit:hover {
        background: #5fd6a5;
        border-color: #5fd6a5;
        color: #064e3b;
    }

    [data-bs-theme="dark"] .empty-icon {
        background: rgba(95, 214, 165, .08);
    }

    /* ================================
       ANIMATION
    ================================= */
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

    @media (max-width: 767.98px) {

        .hero-wrap {
            padding: 2rem 1rem;
        }

        .hero-wrap h1 {
            font-size: 1.8rem;
        }

        .card-header-brand {
            flex-direction: column;
            align-items: flex-start !important;
            gap: .75rem;
        }

        .inventory-table {
            min-width: 760px;
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

<div class="container-fluid py-4 px-4 alat-page">

    {{-- Alert Notifikasi Sukses --}}
    @if(session('success'))
        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4"
            role="alert"
        >
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>

                <div class="small fw-medium">
                    {{ session('success') }}
                </div>
            </div>

            <button
                type="button"
                class="btn-close shadow-none"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
        </div>
    @endif


    {{-- Hero Section --}}
    <section class="text-center hero-wrap mb-4 shadow-sm">

        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
            <i class="bi bi-tools me-1"></i>
            Daftar Alat Olahraga
        </span>

        <h1 class="display-6 fw-bold mb-2">
            Daftar <span class="text-brand">Alat Olahraga</span>
        </h1>

        <p
            class="mx-auto mb-4"
            style="max-width: 560px;"
        >
            Kelola data barang dan perangkat kebutuhan olahragamu —
            tambah baru, perbarui data, atau hapus item sesuai kebutuhan.
        </p>

        <a
            href="{{ route('alat.create') }}"
            class="btn btn-brand px-4 py-2 d-inline-flex align-items-center gap-2"
        >
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Tambah Alat  Olahraga Baru</span>
        </a>

    </section>


    {{-- Card Tabel --}}
    <div class="card card-brand shadow-sm mb-4">

        <div
            class="card-header card-header-brand bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between"
        >

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-box-seam inventory-icon fs-5"></i>

                <h6 class="fw-bold mb-0 text-body">
                    Data Alat Olahraga
                </h6>

            </div>

            <span
                class="badge bg-body-tertiary text-body-secondary border px-3 py-1.5 rounded-pill small fw-normal"
            >
                Total: {{ count($datal) }} Unit
            </span>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0 inventory-table">

                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">

                        <tr>

                            <th
                                class="py-3 px-4 text-center"
                                style="width: 5%;"
                            >
                                No
                            </th>

                            <th class="py-3 px-3">
                                Nama Alat
                            </th>

                            <th class="py-3 px-3">
                                Kode Alat
                            </th>

                            <th class="py-3 px-3">
                                Kategori
                            </th>

                            <th
                                class="py-3 px-4 text-center"
                                style="width: 180px;"
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y">

                        @php $no = 1; @endphp

                        @forelse ($datal as $alats)

                            <tr>

                                <td class="px-4 text-center text-body-secondary fw-medium fs-7">
                                    {{ $no++ }}
                                </td>

                                <td class="px-3">

                                    <span class="fw-bold text-body fs-7">
                                        {{ $alats->nama_alat }}
                                    </span>

                                </td>

                                <td class="px-3">

                                    <code class="inline">
                                        #{{ $alats->kode_alat }}
                                    </code>

                                </td>

                                <td class="px-3">

                                    @php
                                        $namaKategori = '-';

                                        if (isset($alats->kategori)) {
                                            $namaKategori = $alats->kategori->nama_kategori;
                                        } else {
                                            foreach ($kategori as $k) {
                                                if ($k->id_kategori == $alats->id_kategori) {
                                                    $namaKategori = $k->nama_kategori;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp

                                    <span class="badge-kategori fs-8">
                                        <i class="bi bi-tag-fill me-1 opacity-75"></i>
                                        {{ $namaKategori }}
                                    </span>

                                </td>

                                <td class="px-4 text-center">

                                    <div class="d-inline-flex align-items-center justify-content-center gap-1.5">

                                        <a
                                            href="{{ route('alat.edit', ['alat' => $alats->id_alat]) }}"
                                            class="btn btn-sm btn-edit fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                            title="Edit Data"
                                        >
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>


                                        <form
                                            action="{{ route('alat.delete', ['id' => $alats->id_alat]) }}"
                                            method="POST"
                                            class="d-inline m-0"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?')"
                                                title="Hapus Data"
                                            >
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center py-5 text-body-secondary"
                                >

                                    <div class="d-flex flex-column align-items-center gap-2">

                                        <div class="empty-icon mb-1">

                                            <i class="bi bi-inbox text-body-secondary fs-2 opacity-50"></i>

                                        </div>

                                        <h6 class="fw-bold mb-0 text-body">
                                            Belum Ada Data Alat Olahraga
                                        </h6>

                                        <span class="fs-7 text-body-secondary">
                                            Silakan tambahkan data alat Olahraga baru.
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
        @if(method_exists($datal, 'hasPages') && $datal->hasPages())

            <div class="card-footer bg-transparent py-3 border-top d-flex justify-content-end">

                {!! $datal->links() !!}

            </div>

        @endif

    </div>

</div>

@endsection