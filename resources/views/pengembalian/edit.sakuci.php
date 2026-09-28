@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Pengembalian Alat')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #2563eb;
        --brand-2: #7c3aed;
        --hero-bg-light: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.08), transparent 45%),
                         radial-gradient(circle at 80% 30%, rgba(124, 58, 237, 0.08), transparent 45%);
        --hero-bg-dark: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.18), transparent 45%),
                        radial-gradient(circle at 80% 30%, rgba(124, 58, 237, 0.18), transparent 45%);
    }

    .hero-wrap {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        padding: 2.5rem 1.5rem;
        background: var(--hero-bg-light);
        border: 1px solid rgba(127, 127, 127, 0.12);
        transition: background 0.3s ease;
    }

    .badge-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        color: #fff !important;
        font-weight: 600;
        letter-spacing: .03em;
        box-shadow: 0 4px 18px rgba(37, 99, 235, 0.25);
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
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
        transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
    }
    .btn-brand:hover,
    .btn-brand:focus {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 26px rgba(37, 99, 235, 0.4);
        filter: brightness(1.05);
    }

    .card-brand {
        border: 1px solid rgba(127, 127, 127, 0.12);
        border-radius: 1.2rem;
        background: var(--bs-body-bg);
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    /* Support Dark Mode Otomatis */
    [data-bs-theme="dark"] .hero-wrap {
        background: var(--hero-bg-dark);
        border-color: rgba(255, 255, 255, 0.08);
    }
</style>

<div class="container-fluid py-4 px-4">
    
    {{-- Hero Section --}}
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

    {{-- Card Pembungkus Form --}}
    <div class="card card-brand shadow-sm overflow-hidden mb-4">
        
        {{-- Header Card --}}
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-journal-text text-primary fs-5"></i>
                <h6 class="fw-bold mb-0 text-body">Formulir Perubahan Data Pengembalian</h6>
            </div>
            <a href="{{ route('pengembalian.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('pengembalian.update', [$data->id_pengembalian]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- ID Peminjaman --}}
                    <div class="col-md-6">
                        <label for="id_peminjaman" class="form-label fw-semibold fs-7 text-body-secondary">ID Peminjaman</label>
                        <select class="form-select rounded-3 shadow-none" id="id_peminjaman" name="id_peminjaman" required>
                            <option value="">-- Pilih Peminjaman --</option>
                            @foreach($peminjaman as $p)
                                <option value="{{ $p->id_peminjaman }}" {{ ($data->id_peminjaman == $p->id_peminjaman) ? 'selected' : '' }}>
                                    #{{ $p->id_peminjaman }} - ({{ $p->status ?? 'Dipinjam' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Pengembalian --}}
                    <div class="col-md-6">
                        <label for="tanggal_pengembalian" class="form-label fw-semibold fs-7 text-body-secondary">Tanggal Pengembalian</label>
                        <input type="date" class="form-control rounded-3 shadow-none" id="tanggal_pengembalian" name="tanggal_pengembalian" value="{{ $data->tanggal_pengembalian }}" required>
                    </div>

                    {{-- Keterlambatan Hari --}}
                    <div class="col-md-6">
                        <label for="terlambat_hari" class="form-label fw-semibold fs-7 text-body-secondary">Keterlambatan (Hari)</label>
                        <input type="number" min="0" class="form-control rounded-3 shadow-none" id="terlambat_hari" name="terlambat_hari" value="{{ $data->terlambat_hari }}">
                    </div>

                    {{-- Denda --}}
                    <div class="col-md-6">
                        <label for="denda" class="form-label fw-semibold fs-7 text-body-secondary">Nominal Denda (Rp)</label>
                        <input type="number" min="0" class="form-control rounded-3 shadow-none" id="denda" name="denda" value="{{ $data->denda }}">
                    </div>

                    {{-- Kondisi Barang --}}
                    <div class="col-12">
                        <label for="kondisi_barang" class="form-label fw-semibold fs-7 text-body-secondary">Kondisi Barang</label>
                        <input type="text" class="form-control rounded-3 shadow-none" id="kondisi_barang" name="kondisi_barang" value="{{ $data->kondisi_barang }}" placeholder="Contoh: Baik, Rusak Ringan, dll.">
                    </div>

                    {{-- Catatan --}}
                    <div class="col-12">
                        <label for="catatan" class="form-label fw-semibold fs-7 text-body-secondary">Catatan (Opsional)</label>
                        <textarea class="form-control rounded-3 shadow-none" id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan...">{{ $data->catatan }}</textarea>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex align-items-center justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('pengembalian.index') }}" class="btn btn-light px-4 py-2.5 rounded-3 fw-medium border">
                        Batal
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