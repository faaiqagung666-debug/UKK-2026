@extends('layouts.app')

@section('title', config('app.name') . ' -- Ajukan Peminjaman Alat')

@section('content')

{{-- Google Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,600;12..96,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --soft-green: #eaf8f1;
        --border-green: rgba(13, 122, 80, 0.15);
    }

    .pengajuan-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        animation: fadeUp .55s ease both;
    }

    .pengajuan-page h1,
    .pengajuan-page h2,
    .pengajuan-page h3,
    .pengajuan-page h4,
    .pengajuan-page h5 {
        font-family: 'Bricolage Grotesque', sans-serif;
    }

    .pengajuan-card {
        border: 0 !important;
        border-radius: 1.35rem !important;
        overflow: hidden;
        background: var(--bs-body-bg);
        box-shadow: 0 12px 35px rgba(6, 78, 59, .10) !important;
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .pengajuan-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 42px rgba(6, 78, 59, .15) !important;
    }

    .pengajuan-header {
        background: linear-gradient(135deg, var(--brand-2), var(--brand-1));
        color: #fff;
        padding: 1.35rem 1.5rem !important;
        border-bottom: 0 !important;
        position: relative;
        overflow: hidden;
    }

    .pengajuan-header::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(217, 242, 75, .14);
        right: -70px;
        top: -90px;
    }

    .pengajuan-header h4 {
        position: relative;
        z-index: 1;
        letter-spacing: -.02em;
    }

    .pengajuan-header p {
        position: relative;
        z-index: 1;
        color: rgba(255, 255, 255, .78) !important;
    }

    .pengajuan-body {
        padding: 1.75rem !important;
    }

    .pengajuan-page .form-label {
        font-size: .88rem;
        color: var(--bs-body-color);
        margin-bottom: .5rem;
    }

    .pengajuan-page .form-control,
    .pengajuan-page .form-select {
        border-radius: .8rem;
        border: 1px solid var(--bs-border-color);
        min-height: 45px;
        padding: .65rem .85rem;
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    }

    .pengajuan-page .form-control:focus,
    .pengajuan-page .form-select:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem rgba(13, 122, 80, .12);
    }

    .pengajuan-page .form-control:hover,
    .pengajuan-page .form-select:hover {
        border-color: rgba(13, 122, 80, .45);
    }

    .pengajuan-page .text-muted {
        color: var(--bs-secondary-color) !important;
    }

    .btn-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        border: 0;
        color: #fff;
        border-radius: .75rem;
        font-weight: 700;
        padding: .65rem 1.2rem;
        transition: all .25s ease;
    }

    .btn-brand:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(13, 122, 80, .25);
    }

    .btn-outline-brand {
        border: 1px solid var(--brand-1);
        color: var(--brand-1);
        background: transparent;
        border-radius: .75rem;
        font-weight: 600;
        transition: all .25s ease;
    }

    .btn-outline-brand:hover {
        background: var(--brand-1);
        border-color: var(--brand-1);
        color: #fff;
        transform: translateY(-2px);
    }

    .form-section {
        position: relative;
    }

    .form-section::before {
        content: "";
        position: absolute;
        left: -1.75rem;
        top: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(to bottom, var(--whistle), var(--brand-1));
        border-radius: 5px;
        opacity: .8;
    }

    .action-area {
        padding-top: .5rem;
    }

    .pengajuan-page .row > div {
        animation: slideDown .5s ease both;
    }

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

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 576px) {
        .pengajuan-body {
            padding: 1.25rem !important;
        }

        .pengajuan-header {
            padding: 1.15rem !important;
        }

        .form-section::before {
            left: -1.25rem;
        }

        .action-area {
            gap: .75rem;
        }

        .action-area .btn {
            padding-left: .8rem !important;
            padding-right: .8rem !important;
        }
    }

    /* Dark Mode */
    [data-bs-theme="dark"] .pengajuan-card {
        box-shadow: 0 12px 35px rgba(0, 0, 0, .25) !important;
    }

    [data-bs-theme="dark"] .pengajuan-page .form-control,
    [data-bs-theme="dark"] .pengajuan-page .form-select {
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
    }

    [data-bs-theme="dark"] .btn-outline-brand {
        color: #73d8ae;
        border-color: #73d8ae;
    }

    [data-bs-theme="dark"] .btn-outline-brand:hover {
        color: #fff;
        background: var(--brand-1);
        border-color: var(--brand-1);
    }
</style>

<div class="container-fluid py-4 pengajuan-page">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card pengajuan-card">

                <div class="card-header pengajuan-header">
                    <h4 class="fw-bold mb-1">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Form Pengajuan Peminjaman Alat
                    </h4>

                    <p class="small mb-0">
                        Silakan isi formulir di bawah ini untuk mengajukan peminjaman alat inventaris.
                    </p>
                </div>

                <div class="card-body pengajuan-body">

                    {{-- =========================================================
                        ROUTE FORM PEMINJAMAN
                        Menggunakan route yang memang terdaftar di routes.php
                    ========================================================== --}}
                    @php
                        $storeRoute = route('peminjam.storePeminjam');
                        $indexRoute = route('peminjam.indexPeminjam');
                    @endphp

                    <form action="{{ $storeRoute }}" method="POST">
                        @csrf

                        <div class="form-section">

                            {{-- Pilihan Alat --}}
                            <div class="mb-3">
                                <label for="id_alat" class="form-label fw-semibold">
                                    <i class="bi bi-tools me-1 text-success"></i>
                                    Pilih Alat
                                </label>

                                <select
                                    name="id_alat"
                                    id="id_alat"
                                    class="form-select"
                                    required
                                >
                                    <option value="">
                                        -- Pilih Alat Inventaris --
                                    </option>

                                    @foreach($alat as $item)
                                        <option
                                            value="{{ $item->id_alat }}"
                                            {{ (isset($selectedAlatId) && $selectedAlatId == $item->id_alat) ? 'selected' : '' }}
                                        >
                                            {{ $item->nama_alat ?? $item->nama }}

                                            @if(isset($item->stok))
                                                (Stok: {{ $item->stok }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Jumlah --}}
                            <div class="mb-3">
                                <label for="jumlah" class="form-label fw-semibold">
                                    <i class="bi bi-123 me-1 text-success"></i>
                                    Jumlah Unit
                                </label>

                                <input
                                    type="number"
                                    name="jumlah"
                                    id="jumlah"
                                    class="form-control"
                                    min="1"
                                    required
                                    placeholder="Masukkan jumlah unit yang dipinjam"
                                >
                            </div>

                            {{-- Tanggal Pinjam --}}
                            <div class="mb-3">
                                <label for="tanggal_pinjam" class="form-label fw-semibold">
                                    <i class="bi bi-calendar-event me-1 text-success"></i>
                                    Tanggal Pinjam
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_pinjam"
                                    id="tanggal_pinjam"
                                    class="form-control"
                                    required
                                >
                            </div>

                            {{-- Tanggal Kembali --}}
                            <div class="mb-4">
                                <label for="tanggal_kembali" class="form-label fw-semibold">
                                    <i class="bi bi-calendar-check me-1 text-success"></i>
                                    Rencana Tanggal Kembali
                                    <span class="text-muted fw-normal">
                                        (Opsional)
                                    </span>
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_kembali"
                                    id="tanggal_kembali"
                                    class="form-control"
                                >
                            </div>

                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-between align-items-center action-area">

                            <a
                                href="{{ $indexRoute }}"
                                class="btn btn-outline-brand px-3"
                            >
                                <i class="bi bi-arrow-left me-1"></i>
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="btn btn-brand px-4 shadow-sm"
                            >
                                <i class="bi bi-send me-1"></i>
                                Kirim Pengajuan
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection