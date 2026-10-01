@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Pengembalian')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.22);

        --page-bg-light:
            radial-gradient(circle at 10% 10%, rgba(13, 122, 80, 0.07), transparent 35%),
            radial-gradient(circle at 90% 20%, rgba(217, 242, 75, 0.10), transparent 35%),
            linear-gradient(135deg, #f8fffb 0%, #eefaf4 100%);

        --page-bg-dark:
            radial-gradient(circle at 10% 10%, rgba(13, 122, 80, 0.16), transparent 35%),
            radial-gradient(circle at 90% 20%, rgba(217, 242, 75, 0.07), transparent 35%),
            linear-gradient(135deg, #071b14 0%, #0b241b 100%);
    }

    .pengembalian-page {
        min-height: 75vh;
        background: var(--page-bg-light);
        border-radius: 1.4rem;
        animation: fadeUp .5s ease both;
    }

    .page-header {
        padding: 1.4rem 1.5rem;
        border-radius: 1.25rem;
        background: rgba(255, 255, 255, .82);
        border: 1px solid rgba(13, 122, 80, .10);
        box-shadow: 0 10px 30px rgba(13, 122, 80, .06);
    }

    .page-icon {
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        color: var(--whistle);
        font-size: 1.35rem;
        box-shadow: 0 7px 18px var(--brand-glow);
        flex-shrink: 0;
    }

    .page-header h3 {
        color: var(--brand-2);
        letter-spacing: -.02em;
    }

    .btn-back {
        border: 1px solid rgba(13, 122, 80, .22);
        color: var(--brand-2);
        background: #fff;
        font-weight: 600;
        border-radius: .8rem;
        transition: .18s ease;
    }

    .btn-back:hover {
        color: var(--brand-2);
        border-color: var(--brand-1);
        background: #f0faf5;
        transform: translateY(-1px);
    }

    .return-card {
        border: 1px solid rgba(13, 122, 80, .12);
        border-radius: 1.3rem;
        background: rgba(255, 255, 255, .96);
        box-shadow: 0 18px 45px rgba(13, 122, 80, .10);
        overflow: hidden;
    }

    .return-card-header {
        padding: 1.15rem 1.5rem;
        background: linear-gradient(
            90deg,
            rgba(13, 122, 80, .07),
            rgba(217, 242, 75, .06)
        );
        border-bottom: 1px solid rgba(13, 122, 80, .10);
    }

    .return-card-header i {
        color: var(--brand-1);
    }

    .form-label {
        color: var(--brand-2);
        margin-bottom: .5rem;
    }

    .form-control,
    .form-select {
        border-radius: .8rem;
        border: 1px solid #d7e7df;
        padding: .7rem .9rem;
        transition: .2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .22rem var(--brand-glow);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 95px;
    }

    .btn-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        border: none;
        color: #fff;
        font-weight: 700;
        border-radius: .8rem;
        box-shadow: 0 7px 18px var(--brand-glow);
        transition: .2s ease;
    }

    .btn-brand:hover,
    .btn-brand:focus {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 11px 25px rgba(13, 122, 80, .34);
    }

    .btn-brand i {
        color: var(--whistle);
    }

    .btn-cancel {
        border: 1px solid #d7e7df;
        color: var(--brand-2);
        background: #fff;
        border-radius: .8rem;
        font-weight: 600;
        transition: .18s ease;
    }

    .btn-cancel:hover {
        color: var(--brand-2);
        background: #f0faf5;
        border-color: rgba(13, 122, 80, .28);
        transform: translateY(-1px);
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    [data-bs-theme="dark"] .pengembalian-page {
        background: var(--page-bg-dark);
    }

    [data-bs-theme="dark"] .page-header,
    [data-bs-theme="dark"] .return-card {
        background: #0f211a;
        border-color: rgba(255, 255, 255, .08);
    }

    [data-bs-theme="dark"] .page-header h3,
    [data-bs-theme="dark"] .form-label {
        color: #dff7ea;
    }

    [data-bs-theme="dark"] .return-card-header {
        background: linear-gradient(
            90deg,
            rgba(13, 122, 80, .14),
            rgba(217, 242, 75, .05)
        );
        border-color: rgba(255, 255, 255, .08);
    }

    [data-bs-theme="dark"] .form-control,
    [data-bs-theme="dark"] .form-select {
        background-color: #10271f;
        color: #e8f5ef;
        border-color: #244438;
    }

    [data-bs-theme="dark"] .form-control:focus,
    [data-bs-theme="dark"] .form-select:focus {
        background-color: #10271f;
        color: #fff;
        border-color: var(--brand-1);
    }

    [data-bs-theme="dark"] .btn-back,
    [data-bs-theme="dark"] .btn-cancel {
        background: #10271f;
        color: #dff7ea;
        border-color: #244438;
    }

    [data-bs-theme="dark"] .btn-back:hover,
    [data-bs-theme="dark"] .btn-cancel:hover {
        background: #16372b;
        color: #fff;
    }

    @media (max-width: 576px) {
        .pengembalian-page {
            padding-left: .75rem !important;
            padding-right: .75rem !important;
        }

        .page-header {
            padding: 1.2rem;
        }

        .return-card .card-body {
            padding: 1.2rem !important;
        }

        .action-buttons {
            flex-direction: column-reverse;
        }

        .action-buttons .btn {
            width: 100%;
        }
    }
</style>

<div class="container-fluid py-4 px-4 pengembalian-page">

    <!-- Header Halaman -->
    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">

        <div class="d-flex align-items-center gap-3">
            <div class="page-icon">
                <i class="bi bi-box-arrow-in-down"></i>
            </div>

            <div>
                <h3 class="fw-bold mb-1">
                    Tambah Data Pengembalian
                </h3>

                <p class="text-body-secondary small mb-0">
                    Catat pengembalian alat inventaris dan hitung denda jika ada.
                </p>
            </div>
        </div>

        <a
            href="{{ route('pengembalian.index') }}"
            class="btn btn-back btn-sm px-3 py-2 d-inline-flex align-items-center gap-2"
        >
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>

    </div>

    <!-- Card Form -->
    <div class="card return-card">

        <div class="return-card-header d-flex align-items-center gap-2">
            <i class="bi bi-clipboard-check fs-5"></i>

            <h6 class="fw-bold mb-0 text-body">
                Formulir Pengembalian Alat
            </h6>
        </div>

        <div class="card-body p-4">

            <form action="{{ route('pengembalian.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <!-- Peminjaman ID -->
                    <div class="col-md-6">
                        <label
                            for="id_peminjaman"
                            class="form-label fw-semibold"
                        >
                            Pilih Peminjaman
                        </label>

                        <select
                            name="id_peminjaman"
                            id="id_peminjaman"
                            class="form-select"
                            required
                        >
                            <option value="">
                                -- Pilih Peminjaman Belum Dikembalikan --
                            </option>

                            @foreach($peminjaman as $p)
                                @php
                                    $pid = $p->id_peminjaman ?? $p->id;
                                    $uid = $p->user->nama ?? $p->id_user ?? '-';
                                    $aid = $p->alat->nama_alat ?? $p->id_alat ?? '-';
                                @endphp

                                <option
                                    value="{{ $pid }}"
                                    {{ old('id_peminjaman') == $pid ? 'selected' : '' }}
                                >
                                    ID #{{ $pid }} (User: {{ $uid }}, Alat: {{ $aid }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Pengembalian -->
                    <div class="col-md-6">
                        <label
                            for="tanggal_pengembalian"
                            class="form-label fw-semibold"
                        >
                            Tanggal Pengembalian
                        </label>

                        <input
                            type="datetime-local"
                            name="tanggal_pengembalian"
                            id="tanggal_pengembalian"
                            class="form-control"
                            value="{{ old('tanggal_pengembalian', date('Y-m-d\TH:i')) }}"
                            required
                        >
                    </div>

                    <!-- Terlambat -->
                    <div class="col-md-4">
                        <label
                            for="terlambat_hari"
                            class="form-label fw-semibold"
                        >
                            Terlambat (Hari)
                        </label>

                        <input
                            type="number"
                            min="0"
                            name="terlambat_hari"
                            id="terlambat_hari"
                            class="form-control"
                            value="{{ old('terlambat_hari', 0) }}"
                        >
                    </div>

                    <!-- Denda -->
                    <div class="col-md-4">
                        <label
                            for="denda"
                            class="form-label fw-semibold"
                        >
                            Denda (Rp)
                        </label>

                        <input
                            type="number"
                            min="0"
                            name="denda"
                            id="denda"
                            class="form-control"
                            value="{{ old('denda', 0) }}"
                        >
                    </div>

                    <!-- Kondisi Barang -->
                    <div class="col-md-4">
                        <label
                            for="kondisi_barang"
                            class="form-label fw-semibold"
                        >
                            Kondisi Barang
                        </label>

                        <select
                            name="kondisi_barang"
                            id="kondisi_barang"
                            class="form-select"
                        >
                            <option
                                value="Baik"
                                {{ old('kondisi_barang', 'Baik') == 'Baik' ? 'selected' : '' }}
                            >
                                Baik
                            </option>

                            <option
                                value="Rusak Ringan"
                                {{ old('kondisi_barang') == 'Rusak Ringan' ? 'selected' : '' }}
                            >
                                Rusak Ringan
                            </option>

                            <option
                                value="Rusak Berat"
                                {{ old('kondisi_barang') == 'Rusak Berat' ? 'selected' : '' }}
                            >
                                Rusak Berat
                            </option>

                            <option
                                value="Hilang"
                                {{ old('kondisi_barang') == 'Hilang' ? 'selected' : '' }}
                            >
                                Hilang
                            </option>
                        </select>
                    </div>

                    <!-- Catatan -->
                    <div class="col-12">
                        <label
                            for="catatan"
                            class="form-label fw-semibold"
                        >
                            Catatan
                        </label>

                        <textarea
                            name="catatan"
                            id="catatan"
                            rows="3"
                            class="form-control"
                            placeholder="Tambahkan catatan jika diperlukan..."
                        >{{ old('catatan') }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="col-12 d-flex justify-content-end gap-2 mt-4 pt-3 border-top action-buttons">

                        <a
                            href="{{ route('pengembalian.index') }}"
                            class="btn btn-cancel px-4 py-2"
                        >
                            <i class="bi bi-x-circle me-1"></i>
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-brand px-4 py-2"
                        >
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Simpan Pengembalian
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection