@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambahkan Alat')

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

    .alat-form-page {
        animation: fadeUp .45s ease both;
    }

    .form-card {
        border: 1px solid rgba(127, 127, 127, .12);
        border-radius: 1.5rem;
        background: var(--form-bg-light);
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(6, 78, 59, .06);
        transition:
            background .3s ease,
            border-color .3s ease,
            box-shadow .25s ease;
    }

    .form-card::before {
        content: "";
        display: block;
        height: 4px;
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
    }

    .form-header {
        padding: 1.75rem 2rem 1.25rem;
    }

    .header-icon {
        width: 48px;
        height: 48px;
        border-radius: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(13, 122, 80, .10);
        color: var(--brand-1);
        font-size: 1.3rem;
    }

    .form-title {
        font-weight: 800;
        letter-spacing: -.02em;
    }

    .form-subtitle {
        line-height: 1.6;
    }

    .form-body {
        padding: 1rem 2rem 2rem;
    }

    .form-label {
        font-weight: 650;
        color: var(--bs-body-color);
        margin-bottom: .5rem;
    }

    .form-control,
    .form-select {
        border-radius: .8rem;
        border-color: rgba(127, 127, 127, .20);
        padding: .7rem .9rem;
        transition:
            border-color .18s ease,
            box-shadow .18s ease,
            background-color .18s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .22rem rgba(13, 122, 80, .13);
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .field-icon {
        color: var(--brand-1);
        margin-right: .35rem;
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

    .form-footer {
        border-top: 1px solid rgba(127, 127, 127, .12);
        padding-top: 1.25rem;
        margin-top: 1.5rem;
        display: flex;
        justify-content: flex-end;
    }

    /* Dark Mode */
    [data-bs-theme="dark"] .form-card {
        background: var(--form-bg-dark);
        border-color: rgba(255, 255, 255, .08);
        box-shadow: 0 12px 35px rgba(0, 0, 0, .16);
    }

    [data-bs-theme="dark"] .header-icon {
        background: rgba(95, 214, 165, .10);
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

    [data-bs-theme="dark"] .field-icon {
        color: #5fd6a5;
    }

    [data-bs-theme="dark"] .form-footer {
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
        .form-header,
        .form-body {
            padding-left: 1.25rem;
            padding-right: 1.25rem;
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

<div class="container-fluid py-4 px-4 alat-form-page">

    <div class="row justify-content-center">

        <div class="col-12 col-md-9 col-lg-7 col-xl-6">

            <div class="card form-card border-0">

                {{-- Header --}}
                <div class="form-header">

                    <div class="d-flex align-items-center gap-3">

                        <div class="header-icon">
                            <i class="bi bi-tools"></i>
                        </div>

                        <div>
                            <span class="badge rounded-pill px-3 py-2 mb-1"
                                  style="
                                      background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
                                      color: #fff;
                                      font-weight: 600;
                                  ">
                                Inventaris Sarpras
                            </span>

                            <h1 class="h4 form-title text-body mb-0">
                                Tambahkan Alat
                            </h1>
                        </div>

                    </div>

                    <p class="text-body-secondary small form-subtitle mb-0 mt-3">
                        Tambahkan data alat inventaris baru beserta kode dan kategori alat.
                    </p>

                </div>

                {{-- Form --}}
                <div class="form-body">

                    <form action="{{ route('alat.store') }}" method="POST">
                        @csrf

                        {{-- Nama Alat --}}
                        <div class="form-group">

                            <label
                                for="nama_alat"
                                class="form-label"
                            >
                                <i class="bi bi-box-seam field-icon"></i>
                                Nama Alat
                            </label>

                            <input
                                type="text"
                                name="nama_alat"
                                id="nama_alat"
                                class="form-control"
                                value="{{ old('nama_alat') }}"
                                placeholder="Masukkan nama alat"
                                required
                            >

                        </div>

                        {{-- Kode Alat --}}
                        <div class="form-group">

                            <label
                                for="kode_alat"
                                class="form-label"
                            >
                                <i class="bi bi-upc-scan field-icon"></i>
                                Kode Alat
                            </label>

                            <input
                                type="text"
                                name="kode_alat"
                                id="kode_alat"
                                class="form-control"
                                value="{{ old('kode_alat') }}"
                                placeholder="Masukkan kode alat"
                                required
                            >

                        </div>

                        {{-- Kategori --}}
                        <div class="form-group">

                            <label
                                for="id_kategori"
                                class="form-label"
                            >
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
                                        {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}
                                    >
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        {{-- Submit --}}
                        <div class="form-footer">

                            <button
                                type="submit"
                                class="btn btn-brand d-inline-flex align-items-center gap-2"
                            >
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Simpan Alat</span>
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection