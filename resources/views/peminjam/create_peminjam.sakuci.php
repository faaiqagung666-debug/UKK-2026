@extends('layouts.app')

@section('title', config('app.name') . ' -- Ajukan Peminjaman Alat')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,600;12..96,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
    }

    .pengajuan-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        animation: fadeUp .55s ease both;
    }

    .pengajuan-card {
        border: 0 !important;
        border-radius: 1.35rem !important;
        overflow: hidden;
        background: var(--bs-body-bg);
        box-shadow: 0 12px 35px rgba(6, 78, 59, .10) !important;
    }

    .pengajuan-header {
        background: linear-gradient(135deg, var(--brand-2), var(--brand-1));
        color: #fff;
        padding: 1.35rem 1.5rem !important;
    }

    .pengajuan-body {
        padding: 1.75rem !important;
    }

    .pengajuan-page .form-control,
    .pengajuan-page .form-select {
        border-radius: .8rem;
        min-height: 45px;
        padding: .65rem .85rem;
    }

    .btn-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        border: 0;
        color: #fff;
        border-radius: .75rem;
        font-weight: 700;
        padding: .65rem 1.2rem;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
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
                    <p class="small mb-0 text-white-50">
                        Silakan isi formulir di bawah ini untuk mengajukan peminjaman alat inventaris.
                    </p>
                </div>

                <div class="card-body pengajuan-body">

                    @php
                        $storeRoute = route('peminjam.storePeminjam');
                        $indexRoute = route('peminjam.indexPeminjam');
                    @endphp

                    <form action="{{ $storeRoute }}" method="POST">
                        @csrf

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
                                        {{ $item->nama_alat }} 
                                        @if(isset($item->stok))
                                            (Stok Tersedia: {{ $item->stok }})
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
                                Rencana Tanggal Kembali <span class="text-muted fw-normal">(Opsional)</span>
                            </label>
                            <input
                                type="date"
                                name="tanggal_kembali"
                                id="tanggal_kembali"
                                class="form-control"
                            >
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <a href="{{ $indexRoute }}" class="btn btn-outline-secondary px-3 rounded-3">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-brand px-4 shadow-sm">
                                <i class="bi bi-send me-1"></i> Kirim Pengajuan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection