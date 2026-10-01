@extends('layouts.app')

@section('title', 'Tambah Peminjaman Alat')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.22);

        --form-bg-light:
            radial-gradient(circle at top right, rgba(217, 242, 75, 0.18), transparent 35%),
            linear-gradient(135deg, #f8fffb 0%, #eefaf4 100%);

        --form-bg-dark:
            radial-gradient(circle at top right, rgba(217, 242, 75, 0.08), transparent 35%),
            linear-gradient(135deg, #071b14 0%, #0b241b 100%);
    }

    .tambah-peminjaman-page {
        min-height: 75vh;
        background: var(--form-bg-light);
        border-radius: 1.4rem;
        padding: 2rem;
    }

    .peminjaman-card {
        max-width: 850px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.96);
        border: 1px solid rgba(13, 122, 80, 0.12);
        border-radius: 1.4rem;
        box-shadow: 0 18px 45px rgba(13, 122, 80, 0.12);
        overflow: hidden;
        animation: fadeUp .55s ease both;
    }

    .peminjaman-header {
        padding: 1.5rem 1.7rem;
        background: linear-gradient(135deg, var(--brand-2), var(--brand-1));
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .peminjaman-header::after {
        content: "";
        position: absolute;
        width: 170px;
        height: 170px;
        border-radius: 50%;
        background: rgba(217, 242, 75, 0.14);
        right: -55px;
        top: -75px;
    }

    .peminjaman-header .icon-box {
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: rgba(217, 242, 75, 0.18);
        color: var(--whistle);
        font-size: 1.4rem;
        margin-bottom: .8rem;
    }

    .peminjaman-header h2 {
        margin: 0;
        font-size: 1.45rem;
        font-weight: 800;
    }

    .peminjaman-header p {
        margin: .35rem 0 0;
        color: rgba(255, 255, 255, .78);
        font-size: .9rem;
    }

    .peminjaman-body {
        padding: 1.7rem;
    }

    .form-label {
        font-weight: 700;
        color: var(--brand-2);
        margin-bottom: .5rem;
    }

    .form-control,
    .form-select {
        border-radius: .8rem;
        border: 1px solid #d7e7df;
        padding: .75rem .9rem;
        transition: .2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem var(--brand-glow);
    }

    .form-text {
        color: #6c8178;
        font-size: .82rem;
        margin-top: .45rem;
    }

    .btn-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        color: #fff;
        border: none;
        border-radius: .8rem;
        padding: .75rem 1.2rem;
        font-weight: 700;
        box-shadow: 0 8px 18px var(--brand-glow);
        transition: .2s ease;
    }

    .btn-brand:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 12px 24px var(--brand-glow);
    }

    .btn-brand i {
        color: var(--whistle);
    }

    .btn-cancel {
        border-radius: .8rem;
        padding: .75rem 1.2rem;
        font-weight: 700;
        background: #fff;
        color: var(--brand-2);
        border: 1px solid #d7e7df;
        transition: .2s ease;
    }

    .btn-cancel:hover {
        background: #f0faf5;
        color: var(--brand-2);
        border-color: rgba(13, 122, 80, .3);
        transform: translateY(-1px);
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 576px) {
        .tambah-peminjaman-page {
            padding: 1rem;
        }

        .peminjaman-body {
            padding: 1.2rem;
        }

        .peminjaman-header {
            padding: 1.25rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions .btn {
            width: 100%;
        }
    }

    @media (prefers-color-scheme: dark) {
        .tambah-peminjaman-page {
            background: var(--form-bg-dark);
        }

        .peminjaman-card {
            background: #0f211a;
            border-color: rgba(217, 242, 75, 0.1);
        }

        .form-label {
            color: #dff7ea;
        }

        .form-control,
        .form-select {
            background-color: #10271f;
            color: #e8f5ef;
            border-color: #244438;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #10271f;
            color: #fff;
            border-color: var(--brand-1);
        }

        .form-text {
            color: #91a99f;
        }

        .btn-cancel {
            background: #10271f;
            color: #dff7ea;
            border-color: #244438;
        }

        .btn-cancel:hover {
            background: #16372b;
            color: #fff;
        }
    }
</style>

<div class="container-fluid py-4 px-4 tambah-peminjaman-page">

    <div class="peminjaman-card">

        <div class="peminjaman-header">
            <div class="icon-box">
                <i class="bi bi-box-arrow-up-right"></i>
            </div>

            <h2>Tambah Peminjaman Alat</h2>
            <p>Masukkan informasi peminjaman alat ke dalam sistem.</p>
        </div>

        <div class="peminjaman-body">

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                {{-- Pilih User --}}
                <div class="mb-3">
                    <label for="id_user" class="form-label">
                        Pilih User / Peminjam
                    </label>

                    <select name="id_user" id="id_user" class="form-select" required>
                        <option value="">-- Pilih User --</option>

                        @foreach($users as $user)
                            <option value="{{ $user->id_user ?? $user->id }}">
                                {{ $user->nama ?? $user->name ?? $user->username }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Pilih Alat --}}
                <div class="mb-3">
                    <label for="id_alat" class="form-label">
                        Pilih Alat
                    </label>

                    <select name="id_alat" id="id_alat" class="form-select" required>
                        <option value="">-- Pilih Alat --</option>

                        @foreach($alat as $item)
                            <option value="{{ $item->id_alat ?? $item->id }}">
                                {{ $item->nama_alat ?? $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Jumlah --}}
                <div class="mb-3">
                    <label for="jumlah" class="form-label">
                        Jumlah Unit
                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        id="jumlah"
                        class="form-control"
                        value="1"
                        min="1"
                        required
                    >
                </div>

                {{-- Tanggal Pinjam --}}
                <div class="mb-3">
                    <label for="tanggal_pinjam" class="form-label">
                        Tanggal Pinjam
                    </label>

                    <input
                        type="date"
                        name="tanggal_pinjam"
                        id="tanggal_pinjam"
                        class="form-control"
                        value="{{ date('Y-m-d') }}"
                        required
                    >
                </div>

                {{-- Tanggal Kembali --}}
                <div class="mb-3">
                    <label for="tanggal_kembali" class="form-label">
                        Tanggal Kembali (Aktual)
                    </label>

                    <input
                        type="date"
                        name="tanggal_kembali"
                        id="tanggal_kembali"
                        class="form-control"
                    >

                    <div class="form-text">
                        Bisa dikosongkan jika alat belum dikembalikan.
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label">
                        Status Peminjaman
                    </label>

                    <select name="status" id="status" class="form-select" required>
                        <option value="Pending" selected>Pending</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Dipinjam">Dipinjam</option>
                        <option value="Dikembalikan">Dikembalikan</option>
                    </select>
                </div>

                {{-- Denda --}}
                <div class="mb-4">
                    <label for="denda" class="form-label">
                        Denda (Rp)
                    </label>

                    <input
                        type="number"
                        name="denda"
                        id="denda"
                        class="form-control"
                        value="0"
                        min="0"
                    >
                </div>

                <div class="d-flex justify-content-end gap-2 form-actions">
                    <a
                        href="{{ route('peminjaman.index') }}"
                        class="btn btn-cancel px-4"
                    >
                        <i class="bi bi-x-circle me-1"></i>
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-brand px-4"
                    >
                        <i class="bi bi-check-circle-fill me-1"></i>
                        Simpan Peminjaman
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection