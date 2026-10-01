@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Pengembalian Alat')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --font-display: 'Bricolage Grotesque', 'Plus Jakarta Sans', system-ui, sans-serif;
        --font-body: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
    }

    .pengembalian-page {
        font-family: var(--font-body);
    }

    .pengembalian-page .fs-7 {
        font-size: 0.88rem !important;
    }

    .pengembalian-page .fs-8 {
        font-size: 0.75rem !important;
    }

    .pengembalian-page .tracking-wider {
        letter-spacing: 0.06em;
    }

    .pengembalian-page .py-1\.5 {
        padding-top: 0.4rem !important;
        padding-bottom: 0.4rem !important;
    }

    .pengembalian-page .px-2\.5 {
        padding-left: 0.65rem !important;
        padding-right: 0.65rem !important;
    }

    .pengembalian-page .gap-1\.5 {
        gap: 0.4rem !important;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .hero-wrap {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        isolation: isolate;
        padding: 2.75rem 1.5rem;

        background:
            radial-gradient(
                60% 90% at 100% 0%,
                rgba(217, 242, 75, 0.16) 0%,
                rgba(217, 242, 75, 0) 60%
            ),
            linear-gradient(
                145deg,
                #0d7a50 0%,
                #075c3f 42%,
                #08211b 100%
            );

        border: 1px solid rgba(255, 255, 255, 0.14);

        box-shadow:
            0 24px 48px -22px rgba(6, 78, 59, 0.55) !important;
    }

    .hero-wrap::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        opacity: 0.11;

        background-image:
            url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 400' fill='none' stroke='%23ffffff' stroke-width='2'%3E%3Crect x='20' y='20' width='560' height='360'/%3E%3Cpath d='M300 20v360'/%3E%3Ccircle cx='300' cy='200' r='62'/%3E%3Crect x='20' y='120' width='92' height='160'/%3E%3Crect x='488' y='120' width='92' height='160'/%3E%3C/svg%3E");

        background-repeat: no-repeat;
        background-size: 760px auto;
        background-position: center 40%;
    }

    .hero-wrap h1 {
        font-family: var(--font-display);
        font-weight: 800 !important;
        letter-spacing: -0.025em;
        color: #ffffff !important;
        text-wrap: balance;
    }

    .hero-wrap h1 .text-brand {
        color: var(--whistle) !important;
        -webkit-text-fill-color: var(--whistle);
        background: none !important;
        -webkit-background-clip: border-box;
        background-clip: border-box;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.18);
    }

    .hero-wrap p {
        color: rgba(255, 255, 255, 0.9) !important;
        line-height: 1.7;
    }

    /* =========================================================
       BADGE HERO
    ========================================================= */

    .hero-wrap .badge-brand {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        background: var(--whistle) !important;
        color: #052e24 !important;

        font-weight: 800;
        letter-spacing: .03em;

        border: 1px solid rgba(255, 255, 255, 0.35);

        box-shadow:
            0 4px 18px rgba(217, 242, 75, 0.3),
            0 0 0 1px rgba(217, 242, 75, 0.08);
    }

    .hero-wrap .badge-brand i {
        color: #064e3b !important;
    }

    .text-brand {
        background: none;
        -webkit-background-clip: border-box;
        background-clip: border-box;
        color: var(--whistle) !important;
    }

    /* =========================================================
       BUTTON BRAND
    ========================================================= */

    .btn-brand {
        position: relative;
        overflow: hidden;

        background: #ffffff;
        border: 2px solid #ffffff;
        color: var(--brand-2);

        font-weight: 700;
        border-radius: 999px;

        box-shadow:
            0 8px 22px rgba(0, 0, 0, 0.25);

        transition:
            transform .2s ease,
            box-shadow .2s ease,
            background-color .2s ease,
            border-color .2s ease;
    }

    .btn-brand:hover,
    .btn-brand:focus {
        color: #0a2a22;
        background: var(--whistle);
        border-color: var(--whistle);

        transform: translateY(-2px);

        box-shadow:
            0 12px 28px rgba(0, 0, 0, 0.3);
    }

    .btn-brand:focus-visible {
        outline: 3px solid var(--whistle);
        outline-offset: 3px;
    }

    .btn-brand i {
        transition: transform .25s ease;
    }

    .btn-brand:hover i {
        transform: rotate(90deg) scale(1.1);
    }

    /* =========================================================
       CARD
       SAMA DENGAN CARD PEMINJAMAN
    ========================================================= */

    .pengembalian-page .card-brand {
        border: 1px solid var(--bs-border-color-translucent);

        border-radius: 1.2rem;

        background: var(--bs-body-bg);

        box-shadow:
            0 1px 2px rgba(0, 0, 0, 0.04),
            0 14px 30px -20px rgba(6, 78, 59, 0.25) !important;

        transition:
            background 0.3s ease,
            border-color 0.3s ease;
    }

    /* =========================================================
       CARD HEADER
       SAMA DENGAN CARD PEMINJAMAN
    ========================================================= */

    .pengembalian-page .card-brand .card-header {
        background: transparent !important;
        border-bottom: 1px solid var(--bs-border-color);

        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
        padding-left: 1.5rem !important;
        padding-right: 1.5rem !important;
    }

    .pengembalian-page .card-brand .card-header h6 {
        font-family: var(--font-display);
        font-weight: 800 !important;
        letter-spacing: -0.01em;
        font-size: 1.05rem;
    }

    .pengembalian-page .card-brand .card-header .bi-journal-check {
        color: var(--brand-1) !important;
    }

    /* Total badge SAMA DENGAN PEMINJAMAN */

    .pengembalian-page .card-brand .card-header > .badge {
        background: var(--bs-tertiary-bg) !important;
        color: var(--bs-secondary-color) !important;

        border: 1px solid var(--bs-border-color) !important;

        font-weight: 400 !important;
    }

    /* =========================================================
       TABLE
       SAMA DENGAN PEMINJAMAN
    ========================================================= */

    .pengembalian-page .table {
        --bs-table-hover-bg: rgba(13, 122, 80, 0.06);
    }

    .pengembalian-page .table thead th {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        white-space: nowrap;
    }

    .pengembalian-page .table tbody tr {
        transition: background-color 0.2s ease;
    }

    .pengembalian-page .table tbody tr > td:first-child {
        position: relative;
    }

    .pengembalian-page .table tbody tr > td:first-child::before {
        content: "";

        position: absolute;
        left: 0;
        top: 15%;
        bottom: 15%;

        width: 3px;

        border-radius: 0 3px 3px 0;

        background: var(--brand-1);

        transform: scaleY(0);

        transition: transform 0.25s ease;
    }

    .pengembalian-page .table tbody tr:hover > td:first-child::before {
        transform: scaleY(1);
    }

    /* =========================================================
       BUTTON AKSI
       SAMA DENGAN PEMINJAMAN
    ========================================================= */

    .pengembalian-page td .btn {
        transition:
            transform 0.18s ease,
            box-shadow 0.18s ease,
            background-color 0.18s ease,
            color 0.18s ease;
    }

    .pengembalian-page td .btn:hover {
        transform: translateY(-2px);

        box-shadow:
            0 6px 14px -6px rgba(0, 0, 0, 0.35);
    }

    .pengembalian-page td .btn i {
        transition: transform 0.2s ease;
    }

    .pengembalian-page td .btn:hover i {
        transform: scale(1.15) rotate(-6deg);
    }

    /* =========================================================
       FOOTER / PAGINATION
       SAMA DENGAN PEMINJAMAN
    ========================================================= */

    .pengembalian-page .card-brand .card-footer {
        background: transparent !important;

        padding-top: 1rem !important;
        padding-bottom: 1rem !important;

        border-top: 1px solid var(--bs-border-color) !important;
    }

    .pengembalian-page .pagination {
        --bs-pagination-color: var(--brand-1);
        --bs-pagination-hover-color: var(--brand-2);
        --bs-pagination-active-bg: var(--brand-1);
        --bs-pagination-active-border-color: var(--brand-1);
        --bs-pagination-focus-box-shadow:
            0 0 0 0.2rem rgba(13, 122, 80, 0.25);
    }

    /* =========================================================
       ANIMATION
    ========================================================= */

    @keyframes heroIn {
        from {
            opacity: 0;
            transform: translateY(18px) scale(0.985);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-12px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    @keyframes badgePulse {
        0% {
            box-shadow:
                0 4px 18px rgba(217, 242, 75, 0.3),
                0 0 0 0 rgba(217, 242, 75, 0.55);
        }

        70% {
            box-shadow:
                0 4px 18px rgba(217, 242, 75, 0.3),
                0 0 0 10px rgba(217, 242, 75, 0);
        }

        100% {
            box-shadow:
                0 4px 18px rgba(217, 242, 75, 0.3),
                0 0 0 0 rgba(217, 242, 75, 0);
        }
    }

    @keyframes floatY {
        from {
            transform: translateY(0);
        }

        to {
            transform: translateY(-6px);
        }
    }

    @media (prefers-reduced-motion: no-preference) {

        .pengembalian-page .alert {
            animation:
                slideDown 0.5s cubic-bezier(0.2, 0.7, 0.2, 1) backwards;
        }

        .hero-wrap {
            animation:
                heroIn 0.7s cubic-bezier(0.2, 0.7, 0.2, 1) backwards;
        }

        .hero-wrap > * {
            animation:
                fadeUp 0.6s cubic-bezier(0.2, 0.7, 0.2, 1) backwards;
        }

        .hero-wrap > *:nth-child(1) {
            animation-delay: 0.15s;
        }

        .hero-wrap > *:nth-child(2) {
            animation-delay: 0.25s;
        }

        .hero-wrap > *:nth-child(3) {
            animation-delay: 0.35s;
        }

        .hero-wrap > *:nth-child(4) {
            animation-delay: 0.45s;
        }

        .hero-wrap > .badge-brand {
            animation:
                fadeUp 0.6s cubic-bezier(0.2, 0.7, 0.2, 1) 0.15s backwards,
                badgePulse 2.6s ease-out 1.2s infinite;
        }

        .card-brand {
            animation:
                fadeUp 0.6s cubic-bezier(0.2, 0.7, 0.2, 1) 0.4s backwards;
        }

        .pengembalian-page .table tbody tr {
            animation:
                fadeUp 0.45s ease backwards;
        }

        .pengembalian-page .bi-inbox {
            display: inline-block;
            animation: floatY 3s ease-in-out infinite alternate;
        }
    }

    /* =========================================================
       DARK MODE
    ========================================================= */

    [data-bs-theme="dark"] .hero-wrap {
        background:
            radial-gradient(
                60% 90% at 100% 0%,
                rgba(217, 242, 75, 0.08) 0%,
                rgba(217, 242, 75, 0) 60%
            ),
            linear-gradient(
                145deg,
                #064e3b 0%,
                #0a2a22 55%,
                #020a08 100%
            );

        border-color: rgba(255, 255, 255, 0.08);

        box-shadow:
            0 24px 48px -22px rgba(0, 0, 0, 0.7) !important;
    }

    [data-bs-theme="dark"] .hero-wrap .badge-brand {
        background: var(--whistle) !important;
        color: #03251c !important;

        border-color: rgba(217, 242, 75, 0.65);

        box-shadow:
            0 4px 18px rgba(217, 242, 75, 0.25),
            0 0 0 1px rgba(217, 242, 75, 0.08);
    }

    [data-bs-theme="dark"] .hero-wrap .badge-brand i {
        color: #064e3b !important;
    }

    [data-bs-theme="dark"] .hero-wrap h1 {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .hero-wrap h1 .text-brand {
        color: #d9f24b !important;
        -webkit-text-fill-color: #d9f24b;

        text-shadow:
            0 1px 2px rgba(0, 0, 0, 0.45),
            0 0 14px rgba(217, 242, 75, 0.12);
    }

    [data-bs-theme="dark"] .hero-wrap p {
        color: rgba(255, 255, 255, 0.88) !important;
    }

    /* Card tetap mengikuti card Peminjaman */

    [data-bs-theme="dark"] .pengembalian-page .card-brand {
        border-color: rgba(255, 255, 255, 0.08);

        background: var(--bs-body-bg);

        box-shadow:
            0 1px 2px rgba(0, 0, 0, 0.2),
            0 14px 30px -20px rgba(0, 0, 0, 0.45) !important;
    }

    [data-bs-theme="dark"] .pengembalian-page .card-brand .card-header {
        background: transparent !important;
        border-bottom-color: rgba(255, 255, 255, 0.08) !important;
    }

    [data-bs-theme="dark"] .pengembalian-page .card-brand .card-header .bi-journal-check {
        color: var(--whistle) !important;
    }

    [data-bs-theme="dark"] .pengembalian-page .card-brand .card-header > .badge {
        background: var(--bs-tertiary-bg) !important;
        color: var(--bs-secondary-color) !important;
        border-color: var(--bs-border-color) !important;
    }

    [data-bs-theme="dark"] .pengembalian-page .card-brand .card-footer {
        background: transparent !important;
        border-top-color: rgba(255, 255, 255, 0.08) !important;
    }

    [data-bs-theme="dark"] .pengembalian-page .table {
        --bs-table-hover-bg: rgba(217, 242, 75, 0.06);
    }

    [data-bs-theme="dark"] .pengembalian-page .table tbody tr > td:first-child::before {
        background: var(--whistle);
    }

    [data-bs-theme="dark"] .pengembalian-page .pagination {
        --bs-pagination-color: var(--whistle);
        --bs-pagination-active-bg: var(--brand-1);
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 576px) {

        .hero-wrap {
            padding: 2rem 1.1rem;
        }

        .hero-wrap::before {
            background-size: 520px auto;
            opacity: 0.09;
        }

        .hero-wrap .badge-brand {
            font-size: 0.78rem;

            padding-left: 0.85rem !important;
            padding-right: 0.85rem !important;
        }

        .pengembalian-page .card-brand {
            border-radius: 1rem;
        }

        .pengembalian-page .card-brand .card-header {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .btn-brand,
        .btn-brand i,
        .pengembalian-page td .btn,
        .pengembalian-page td .btn i {
            transition: none;
        }

        .btn-brand:hover,
        .pengembalian-page td .btn:hover {
            transform: none;
        }
    }
</style>


<div class="pengembalian-page container-fluid py-4 px-4">

    {{-- Alert Notifikasi Sukses --}}
    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4"
            role="alert">

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
                aria-label="Close">
            </button>

        </div>

    @endif


    {{-- Hero Section --}}
    <section class="text-center hero-wrap mb-4 shadow-sm">

        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">

            <i class="bi bi-arrow-return-left me-1"></i>

            Transaksi Pengembalian

        </span>


        <h1 class="display-6 fw-bold mb-2 text-body">

            Daftar

            <span class="text-brand">
                Pengembalian Alat Oahraga
            </span>

        </h1>


        <p
            class="text-body-secondary mx-auto mb-4"
            style="max-width: 560px;">

            Kelola riwayat pengembalian inventaris alat Olahraga,
            pinalti/denda, dan pengecekan kondisi barang secara transparan.

        </p>


        <a
            href="{{ route('pengembalian.create') }}"
            class="btn btn-brand px-4 py-2.5 d-inline-flex align-items-center gap-2">

            <i class="bi bi-plus-circle-fill fs-6"></i>

            <span>
                Tambah Pengembalian Baru
            </span>

        </a>

    </section>


    {{-- Card Pembungkus Tabel --}}
    <div class="card card-brand shadow-sm overflow-hidden mb-4">

        {{-- Header Card --}}
        <div
            class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-journal-check text-primary fs-5"></i>

                <h6 class="fw-bold mb-0 text-body">
                    Data Transaksi Pengembalian
                </h6>

            </div>


            <span
                class="badge bg-body-tertiary text-body-secondary border px-3 py-1.5 rounded-pill small fw-normal">

                Total: {{ $datap->total() }} Data

            </span>

        </div>


        {{-- Card Body --}}
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead
                        class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">

                        <tr>

                            <th
                                class="py-3 px-4 text-center"
                                style="width: 5%;">

                                No

                            </th>

                            <th class="py-3 px-3">
                                ID Pinjam
                            </th>

                            <th class="py-3 px-3">
                                Tgl Pengembalian
                            </th>

                            <th class="py-3 px-3">
                                Keterlambatan
                            </th>

                            <th class="py-3 px-3">
                                Denda
                            </th>

                            <th class="py-3 px-3">
                                Kondisi Barang
                            </th>

                            <th class="py-3 px-3">
                                Catatan
                            </th>

                            <th
                                class="py-3 px-4 text-center"
                                style="width: 180px;">

                                Aksi

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">

                        @php
                            $no = 1;
                        @endphp


                        @forelse ($datap as $pengembalian)

                            <tr>

                                {{-- NO --}}
                                <td class="px-4 text-center text-body-secondary fw-medium fs-7">

                                    {{ $no++ }}

                                </td>


                                {{-- ID PEMINJAMAN --}}
                                <td class="px-3">

                                    <span
                                        class="badge bg-body-tertiary text-body border fw-semibold px-2.5 py-1.5 rounded-2 fs-8">

                                        #{{ $pengembalian->id_peminjaman }}

                                    </span>

                                </td>


                                {{-- TANGGAL --}}
                                <td class="px-3">

                                    <span class="text-body-secondary fs-7">

                                        <i class="bi bi-calendar-event me-1"></i>

                                        {{ $pengembalian->tanggal_pengembalian }}

                                    </span>

                                </td>


                                {{-- KETERLAMBATAN --}}
                                <td class="px-3">

                                    @if($pengembalian->terlambat_hari > 0)

                                        <span
                                            class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">

                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>

                                            {{ $pengembalian->terlambat_hari }}
                                            Hari

                                        </span>

                                    @else

                                        <span
                                            class="badge bg-success-subtle text-success border border-success border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">

                                            <i class="bi bi-check-circle-fill me-1"></i>

                                            Tepat Waktu

                                        </span>

                                    @endif

                                </td>


                                {{-- DENDA --}}
                                <td class="px-3">

                                    @if(($pengembalian->denda ?? 0) > 0)

                                        <span class="text-danger fw-bold fs-7">

                                            Rp
                                            {{ number_format($pengembalian->denda, 0, ',', '.') }}

                                        </span>

                                    @else

                                        <span class="text-body-secondary fs-7">
                                            Rp 0
                                        </span>

                                    @endif

                                </td>


                                {{-- KONDISI BARANG --}}
                                <td class="px-3">

                                    @php
                                        $kondisi = strtolower(
                                            $pengembalian->kondisi_barang ?? 'baik'
                                        );
                                    @endphp


                                    @if(str_contains($kondisi, 'baik'))

                                        <span
                                            class="badge bg-success-subtle text-success border border-success border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-2 fs-8">

                                            <i class="bi bi-check-lg me-1"></i>

                                            {{ $pengembalian->kondisi_barang ?? 'Baik' }}

                                        </span>

                                    @elseif(str_contains($kondisi, 'rusak'))

                                        <span
                                            class="badge bg-warning-subtle text-warning border border-warning border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-2 fs-8">

                                            <i class="bi bi-tools me-1"></i>

                                            {{ $pengembalian->kondisi_barang }}

                                        </span>

                                    @else

                                        <span
                                            class="badge bg-body-tertiary text-body border fw-semibold px-2.5 py-1.5 rounded-2 fs-8">

                                            {{ $pengembalian->kondisi_barang ?? 'Baik' }}

                                        </span>

                                    @endif

                                </td>


                                {{-- CATATAN --}}
                                <td class="px-3">

                                    <span
                                        class="text-body-secondary text-truncate d-inline-block fs-7"
                                        style="max-width: 180px;"
                                        title="{{ $pengembalian->catatan }}">

                                        {{ $pengembalian->catatan ?? '-' }}

                                    </span>

                                </td>


                                {{-- AKSI --}}
                                <td class="px-4 text-center">

                                    <div
                                        class="d-inline-flex align-items-center justify-content-center gap-1.5">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('pengembalian.edit', ['id_pengembalian' => $pengembalian->id_pengembalian]) }}"
                                            class="btn btn-sm btn-outline-warning fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                            title="Edit Pengembalian">

                                            <i class="bi bi-pencil-square"></i>

                                            Edit

                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('pengembalian.delete', ['id_pengembalian' => $pengembalian->id_pengembalian]) }}"
                                            method="POST"
                                            class="d-inline m-0">

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data pengembalian ini?')"
                                                title="Hapus Data">

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
                                    colspan="8"
                                    class="text-center py-5 text-body-secondary">

                                    <div
                                        class="d-flex flex-column align-items-center gap-2">

                                        <div
                                            class="bg-body-tertiary rounded-circle p-3 mb-1">

                                            <i
                                                class="bi bi-inbox text-body-secondary fs-2 opacity-50">
                                            </i>

                                        </div>


                                        <h6 class="fw-bold mb-0 text-body">

                                            Belum Ada Data Pengembalian

                                        </h6>


                                        <span class="fs-7 text-body-secondary">

                                            Data pengembalian alat yang ditambahkan
                                            akan muncul di sini.

                                        </span>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Bagian Pagination --}}
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())

            <div
                class="card-footer bg-transparent py-3 border-top d-flex justify-content-end">

                {!! $datap->links() !!}

            </div>

        @endif

    </div>

</div>

@endsection