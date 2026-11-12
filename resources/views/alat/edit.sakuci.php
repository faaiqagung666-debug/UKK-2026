@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Alat')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.22);

        --form-bg-light:
            radial-gradient(
                circle at 15% 15%,
                rgba(13, 122, 80, 0.08),
                transparent 45%
            ),
            radial-gradient(
                circle at 85% 80%,
                rgba(6, 78, 59, 0.07),
                transparent 45%
            );

        --form-bg-dark:
            radial-gradient(
                circle at 15% 15%,
                rgba(13, 122, 80, 0.20),
                transparent 45%
            ),
            radial-gradient(
                circle at 85% 80%,
                rgba(217, 242, 75, 0.08),
                transparent 45%
            );
    }

    .edit-alat-page {
        animation: fadeUp .45s ease both;
    }

    .edit-alat-card {
        border: 1px solid rgba(127, 127, 127, .12);
        border-radius: 1.5rem;
        background: var(--form-bg-light);
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(6, 78, 59, .06);
    }

    .edit-alat-card::before {
        content: "";
        display: block;
        height: 4px;
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
    }

    .edit-header {
        padding: 1.75rem 2rem 1.25rem;
    }

    .edit-icon {
        width: 50px;
        height: 50px;
        flex-shrink: 0;
        border-radius: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(13, 122, 80, .10);
        color: var(--brand-1);
        font-size: 1.35rem;
    }

    .edit-title {
        font-weight: 800;
        letter-spacing: -.02em;
    }

    .edit-subtitle {
        line-height: 1.6;
    }

    .edit-body {
        padding: 1rem 2rem 2rem;
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-label {
        font-weight: 650;
        color: var(--bs-body-color);
        margin-bottom: .5rem;
    }

    .field-icon {
        color: var(--brand-1);
        margin-right: .35rem;
    }

    .form-control,
    .form-select {
        border-radius: .8rem;
        border-color: rgba(127, 127, 127, .20);
        padding: .7rem .9rem;
        transition:
            border-color .18s ease,
            box-shadow .18s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .22rem rgba(13, 122, 80, .13);
    }

    .btn-brand {
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
        border: none;
        color: #fff;
        font-weight: 700;
        border-radius: .8rem;
        padding: .7rem 1.5rem;
        box-shadow: 0 6px 20px rgba(13, 122, 80, .25);
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            filter .18s ease;
    }

    .btn-brand:hover,
    .btn-brand:focus {
        color: #fff;
        transform: translateY(-2px);
        filter: brightness(1.05);
        box-shadow: 0 10px 26px rgba(13, 122, 80, .35);
    }

    .edit-footer {
        border-top: 1px solid rgba(127, 127, 127, .12);
        padding-top: 1.25rem;
        margin-top: 1.5rem;
        display: flex;
        justify-content: flex-end;
    }

    /* Dark Mode */
    [data-bs-theme="dark"] .edit-alat-card {
        background: var(--form-bg-dark);
        border-color: rgba(255, 255, 255, .08);
        box-shadow: 0 12px 35px rgba(0, 0, 0, .16);
    }

    [data-bs-theme="dark"] .edit-icon {
        background: rgba(95, 214, 165, .10);
        color: #5fd6a5;
    }

    [data-bs-theme="dark"] .field-icon {
        color: #5fd6a5;
    }

    [data-bs-theme="dark"] .form-control,
    [data-bs-theme="dark"] .form-select {
        border-color: rgba(255, 255, 255, .12);
    }

    [data-bs-theme="dark"] .form-control:focus,
    [data-bs-theme="dark"] .form-select:focus {
        border-color: #5fd6a5;
        box-shadow: 0 0 0 .22rem rgba(95, 214, 165, .12);
    }

    [data-bs-theme="dark"] .edit-footer {
        border-top-color: rgba(255, 255, 255, .08);
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

    @media (max-width: 575.98px) {
        .edit-header,
        .edit-body {
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }

        .edit-footer {
            justify-content: stretch;
        }

        .edit-footer .btn {
            width: 100%;
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

<div class="container-fluid py-4 px-4 edit-alat-page">

    <div class="row justify-content-center">

        <div class="col-12 col-md-9 col-lg-7 col-xl-6">

            <div class="card edit-alat-card border-0">

                {{-- Header --}}
                <div class="edit-header">

                    <div class="d-flex align-items-center gap-3">

                        <div class="edit-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>

                        <div>
                            <span
                                class="badge rounded-pill px-3 py-2 mb-1"
                                style="
                                    background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
                                    color: #fff;
                                    font-weight: 600;
                                "
                            >
                                Inventaris Sarpras
                            </span>

                            <h1 class="h4 edit-title text-body mb-0">
                                Edit Alat
                            </h1>
                        </div>

                    </div>

                    <p class="text-body-secondary small edit-subtitle mb-0 mt-3">
                        Perbarui informasi alat inventaris, kategori, dan stok sesuai data terbaru.
                    </p>

                </div>

                {{-- Form --}}
                <div class="edit-body">

                    <form
                        action="{{ route('alat.update', ['id_alat' => $datal->id_alat]) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        {{-- Nama Alat --}}
                        <div class="form-group">
                            <label for="nama_alat" class="form-label">
                                <i class="bi bi-box-seam field-icon"></i>
                                Nama Alat
                            </label>
                            <input
                                type="text"
                                name="nama_alat"
                                id="nama_alat"
                                class="form-control"
                                value="{{ $datal->nama_alat }}"
                                required
                            >
                        </div>

                        {{-- Kode Alat --}}
                        <div class="form-group">
                            <label for="kode_alat" class="form-label">
                                <i class="bi bi-upc-scan field-icon"></i>
                                Kode Alat
                            </label>
                            <input
                                type="text"
                                name="kode_alat"
                                id="kode_alat"
                                class="form-control"
                                value="{{ $datal->kode_alat }}"
                                required
                            >
                        </div>

                        {{-- Kategori --}}
                        <div class="form-group">
                            <label for="id_kategori" class="form-label">
                                <i class="bi bi-tags field-icon"></i>
                                Kategori
                            </label>
                            <select
                                name="id_kategori"
                                id="id_kategori"
                                class="form-select"
                                required
                            >
                                <option value="">
                                    -- Pilih Kategori --
                                </option>

                                @foreach ($kategori as $k)
                                    <option
                                        value="{{ $k->id_kategori }}"
                                        {{ $datal->id_kategori == $k->id_kategori ? 'selected' : '' }}
                                    >
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Stok Alat --}}
                        <div class="form-group">
                            <label for="stok" class="form-label">
                                <i class="bi bi-stack field-icon"></i>
                                Jumlah Stok
                            </label>
                            <input
                                type="number"
                                name="stok"
                                id="stok"
                                class="form-control"
                                value="{{ $datal->stok }}"
                                min="0"
                                required
                            >
                        </div>

                        {{-- Tombol --}}
                        <div class="edit-footer">
                            <button
                                type="submit"
                                class="btn btn-brand d-inline-flex align-items-center gap-2"
                            >
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection