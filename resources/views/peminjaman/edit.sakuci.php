@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Data Peminjaman')

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
        padding: 2rem 1.5rem;
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

    .form-control, .form-select {
        border-radius: 0.75rem;
        padding: 0.65rem 1rem;
        border-color: rgba(127, 127, 127, 0.25);
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.15);
        border-color: var(--brand-1);
    }

    /* Support Dark Mode Otomatis */
    [data-bs-theme="dark"] .hero-wrap {
        background: var(--hero-bg-dark);
        border-color: rgba(255, 255, 255, 0.08);
    }
</style>

<div class="container-fluid py-4 px-4" style="max-width: 900px;">

    {{-- Hero Section --}}
    <section class="text-center hero-wrap mb-4 shadow-sm">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
            <i class="bi bi-journal-check me-1"></i> Sarpras & Inventaris
        </span>

        <h1 class="display-6 fw-bold mb-2 text-body">
            Edit Data <span class="text-brand">Peminjaman Alat</span>
        </h1>

        <p class="text-body-secondary mx-auto mb-0" style="max-width: 500px;">
            Perbarui informasi peminjaman, status persetujuan, tanggal kembali, serta denda inventaris sekolah.
        </p>
    </section>

    {{-- Card Form --}}
    <div class="card card-brand shadow-sm overflow-hidden">
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center gap-2">
            <i class="bi bi-pencil-square text-primary fs-5"></i>
            <h6 class="fw-bold mb-0 text-body">Formulir Perubahan Peminjaman</h6>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('peminjaman.update', ['id' => $data->id_peminjaman]) }}" method="POST">
                @csrf
                @method('PUT') {{-- Sesuaikan jika menggunakan method PUT/PATCH pada route update --}}

                <div class="mb-3">
                    <label for="id_user" class="form-label fw-semibold text-body">Pilih User / Peminjam</label>
                    <select name="id_user" id="id_user" class="form-select shadow-none" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id_user }}" {{ $data->id_user == $user->id_user ? 'selected' : '' }}>
                                {{ $user->username }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_alat" class="form-label fw-semibold text-body">Pilih Alat</label>
                    <select name="id_alat" id="id_alat" class="form-select shadow-none" required>
                        @foreach($alat as $item)
                            <option value="{{ $item->id_alat }}" {{ $data->id_alat == $item->id_alat ? 'selected' : '' }}>
                                {{ $item->nama_alat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jumlah" class="form-label fw-semibold text-body">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control shadow-none" value="{{ $data->jumlah }}" min="1" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label fw-semibold text-body">Status Peminjaman</label>
                        <select name="status" id="status" class="form-select shadow-none" required>
                            <option value="Pending" {{ $data->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Disetujui" {{ $data->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Ditolak" {{ $data->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="Dikembalikan" {{ $data->status == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_pinjam" class="form-label fw-semibold text-body">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control shadow-none" value="{{ $data->tanggal_pinjam }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal_kembali" class="form-label fw-semibold text-body">Tanggal Kembali (Aktual)</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control shadow-none" value="{{ $data->tanggal_kembali }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="denda" class="form-label fw-semibold text-body">Denda (Rp)</label>
                    <input type="number" name="denda" id="denda" class="form-control shadow-none" value="{{ $data->denda }}" min="0">
                </div>

                <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary px-4 py-2.5 rounded-3 fw-medium">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-brand px-4 py-2.5 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Update Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection