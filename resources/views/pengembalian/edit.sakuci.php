@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Pengembalian Alat')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.22);

        --hero-bg-light:
            radial-gradient(circle at 20% 20%, rgba(13, 122, 80, 0.08), transparent 45%),
            radial-gradient(circle at 80% 30%, rgba(217, 242, 75, 0.12), transparent 45%);

        --hero-bg-dark:
            radial-gradient(circle at 20% 20%, rgba(13, 122, 80, 0.20), transparent 45%),
            radial-gradient(circle at 80% 30%, rgba(217, 242, 75, 0.08), transparent 45%);
    }

    .hero-wrap {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        padding: 2.5rem 1.5rem;
        background: var(--hero-bg-light);
        border: 1px solid rgba(13, 122, 80, 0.12);
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    .badge-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        color: #fff !important;
        font-weight: 600;
        letter-spacing: .03em;
        box-shadow: 0 4px 18px var(--brand-glow);
    }

    .text-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .btn-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: .8rem;
        box-shadow: 0 6px 20px var(--brand-glow);
        transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
    }

    .btn-brand:hover,
    .btn-brand:focus {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 26px rgba(13, 122, 80, 0.38);
        filter: brightness(1.05);
    }

    .card-brand {
        border: 1px solid rgba(13, 122, 80, 0.12);
        border-radius: 1.2rem;
        background: var(--bs-body-bg);
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    .card-brand .card-header {
        border-bottom-color: rgba(13, 122, 80, 0.12) !important;
    }

    .card-brand .card-header i {
        color: var(--brand-1) !important;
    }

    .form-control,
    .form-select {
        border-color: rgba(13, 122, 80, 0.15);
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem rgba(13, 122, 80, 0.12);
    }

    .form-control::placeholder {
        color: var(--bs-secondary-color);
        opacity: .7;
    }

    .btn-outline-secondary:hover {
        border-color: var(--brand-1);
        color: var(--brand-1);
        background: rgba(13, 122, 80, 0.06);
    }

    .btn-light {
        transition: all .18s ease;
    }

    .btn-light:hover {
        border-color: rgba(13, 122, 80, 0.25);
        color: var(--brand-1);
        background: var(--bs-tertiary-bg);
        transform: translateY(-1px);
    }

    .border-top {
        border-color: rgba(13, 122, 80, 0.12) !important;
    }

    [data-bs-theme="dark"] .hero-wrap {
        background: var(--hero-bg-dark);
        border-color: rgba(255, 255, 255, 0.08);
    }

    [data-bs-theme="dark"] .card-brand {
        border-color: rgba(255, 255, 255, 0.08);
    }

    [data-bs-theme="dark"] .card-brand .card-header {
        border-bottom-color: rgba(255, 255, 255, 0.08) !important;
    }

    [data-bs-theme="dark"] .form-control,
    [data-bs-theme="dark"] .form-select {
        border-color: rgba(255, 255, 255, 0.12);
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
    }

    [data-bs-theme="dark"] .form-control:focus,
    [data-bs-theme="dark"] .form-select:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem rgba(13, 122, 80, 0.20);
    }

    [data-bs-theme="dark"] .btn-light {
        background: var(--bs-tertiary-bg);
        color: var(--bs-body-color);
        border-color: rgba(255, 255, 255, 0.12);
    }

    @media (max-width: 576px) {
        .hero-wrap {
            padding: 2rem 1rem;
        }
        .card-brand .card-body {
            padding: 1.25rem !important;
        }
        .d-flex.align-items-center.justify-content-end {
            flex-direction: column-reverse;
            align-items: stretch !important;
        }
        .d-flex.align-items-center.justify-content-end .btn {
            width: 100%;
        }
    }
</style>

<div class="container-fluid py-4 px-4">

    <!-- HERO SECTION -->
    <section class="text-center hero-wrap mb-4 shadow-sm">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
            <i class="bi bi-pencil-square me-1"></i> Form Edit Data
        </span>
        <h1 class="display-6 fw-bold mb-2 text-body">
            Edit <span class="text-brand">Pengembalian Alat</span>
        </h1>
        <p class="text-body-secondary mx-auto mb-0" style="max-width: 560px;">
            Perbarui data transaksi pengembalian inventaris alat, tanggal, kondisi barang, serta rincian denda.
        </p>
    </section>

    <!-- CARD FORM -->
    <div class="card card-brand shadow-sm overflow-hidden mb-4">
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-journal-text fs-5"></i>
                <h6 class="fw-bold mb-0 text-body">Formulir Perubahan Data Pengembalian</h6>
            </div>
            <a href="{{ route('pengembalian.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('pengembalian.update', [$datap->id_pengembalian]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- ID PEMINJAMAN -->
                    <div class="col-md-6">
                        <label for="id_peminjaman" class="form-label fw-semibold fs-7 text-body-secondary">Pilih Peminjaman</label>
                        <select class="form-select rounded-3 shadow-none" id="id_peminjaman" name="id_peminjaman" required>
                            <option value="">-- Pilih Peminjaman --</option>

                            @if(!empty($peminjaman))
                                @foreach($peminjaman as $p)
                                    @php
                                        $pid = $p->id_peminjaman ?? $p->id;
                                        $userObj = $p->user ?? null;
                                        $alatObj = $p->alat ?? null;

                                        $namaUser = $userObj->name ?? $userObj->nama ?? $userObj->username ?? ('User #' . ($p->id_user ?? '-'));
                                        $namaAlat = $alatObj->nama_alat ?? $alatObj->nama ?? ('Alat #' . ($p->id_alat ?? '-'));
                                    @endphp

                                    <option value="{{ $pid }}" {{ ($datap->id_peminjaman == $pid) ? 'selected' : '' }}>
                                        ID #{{ $pid }} (User: {{ $namaUser }}, Alat: {{ $namaAlat }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- TANGGAL PENGEMBALIAN -->
                    <div class="col-md-6">
                        <label for="tanggal_pengembalian" class="form-label fw-semibold fs-7 text-body-secondary">Tanggal Pengembalian</label>
                        <input type="date" class="form-control rounded-3 shadow-none" id="tanggal_pengembalian" name="tanggal_pengembalian" value="{{ $datap->tanggal_pengembalian }}" required>
                    </div>

                    <!-- TERLAMBAT -->
                    <div class="col-md-6">
                        <label for="terlambat_hari" class="form-label fw-semibold fs-7 text-body-secondary">Keterlambatan (Hari)</label>
                        <input type="number" min="0" class="form-control rounded-3 shadow-none" id="terlambat_hari" name="terlambat_hari" value="{{ $datap->terlambat_hari }}">
                    </div>

                    <!-- DENDA -->
                    <div class="col-md-6">
                        <label for="denda" class="form-label fw-semibold fs-7 text-body-secondary">Nominal Denda (Rp)</label>
                        <input type="number" min="0" class="form-control rounded-3 shadow-none" id="denda" name="denda" value="{{ $datap->denda }}">
                    </div>

                    <!-- KONDISI BARANG -->
                    <div class="col-12">
                        <label for="kondisi_barang" class="form-label fw-semibold fs-7 text-body-secondary">Kondisi Barang</label>
                        <input type="text" class="form-control rounded-3 shadow-none" id="kondisi_barang" name="kondisi_barang" value="{{ $datap->kondisi_barang }}" placeholder="Contoh: Baik, Rusak Ringan, dll.">
                    </div>

                    <!-- CATATAN -->
                    <div class="col-12">
                        <label for="catatan" class="form-label fw-semibold fs-7 text-body-secondary">Catatan (Opsional)</label>
                        <textarea class="form-control rounded-3 shadow-none" id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan...">{{ $datap->catatan }}</textarea>
                    </div>

                </div>

                <!-- ACTION BUTTON -->
                <div class="d-flex align-items-center justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('pengembalian.index') }}" class="btn btn-light px-4 py-2.5 rounded-3 fw-medium border">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-brand px-4 py-2.5 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-save-fill fs-6"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection