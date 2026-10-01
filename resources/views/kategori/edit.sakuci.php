@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.22);
        --form-bg-light: radial-gradient(circle at top right, rgba(217, 242, 75, 0.18), transparent 35%),
                         linear-gradient(135deg, #f8fffb 0%, #eefaf4 100%);
        --form-bg-dark: radial-gradient(circle at top right, rgba(217, 242, 75, 0.08), transparent 35%),
                        linear-gradient(135deg, #071b14 0%, #0b241b 100%);
    }

    .edit-kategori-page {
        min-height: 75vh;
        background: var(--form-bg-light);
        border-radius: 1.4rem;
        padding: 2rem;
    }

    .kategori-card {
        max-width: 720px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.96);
        border: 1px solid rgba(13, 122, 80, 0.12);
        border-radius: 1.4rem;
        box-shadow: 0 18px 45px rgba(13, 122, 80, 0.12);
        overflow: hidden;
        animation: fadeUp .55s ease both;
    }

    .kategori-header {
        padding: 1.5rem 1.7rem;
        background: linear-gradient(135deg, var(--brand-2), var(--brand-1));
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .kategori-header::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: rgba(217, 242, 75, 0.14);
        right: -45px;
        top: -65px;
    }

    .kategori-header .icon-box {
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

    .kategori-header h1 {
        margin: 0;
        font-size: 1.45rem;
        font-weight: 800;
        text-transform: capitalize;
    }

    .kategori-header p {
        margin: .35rem 0 0;
        color: rgba(255, 255, 255, .78);
        font-size: .9rem;
    }

    .kategori-body {
        padding: 1.7rem;
    }

    .form-label {
        font-weight: 700;
        color: var(--brand-2);
        margin-bottom: .5rem;
    }

    .form-control {
        border-radius: .8rem;
        border: 1px solid #d7e7df;
        padding: .75rem .9rem;
        transition: .2s ease;
    }

    .form-control:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem var(--brand-glow);
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
        .edit-kategori-page {
            padding: 1rem;
        }

        .kategori-body {
            padding: 1.2rem;
        }

        .kategori-header {
            padding: 1.25rem;
        }
    }

    @media (prefers-color-scheme: dark) {
        .edit-kategori-page {
            background: var(--form-bg-dark);
        }

        .kategori-card {
            background: #0f211a;
            border-color: rgba(217, 242, 75, 0.1);
        }

        .form-label {
            color: #dff7ea;
        }

        .form-control {
            background: #10271f;
            color: #e8f5ef;
            border-color: #244438;
        }

        .form-control:focus {
            background: #10271f;
            color: #fff;
            border-color: var(--brand-1);
        }
    }
</style>

<div class="container-fluid py-4 px-4 edit-kategori-page">

    <div class="kategori-card">

        <div class="kategori-header">
            <div class="icon-box">
                <i class="bi bi-pencil-square"></i>
            </div>

            <h1>Edit Kategori</h1>
            <p>Perbarui informasi kategori alat yang tersedia.</p>
        </div>

        <div class="kategori-body">

            <form action="{{ route('kategori.update', ['id_kategori' => $data->id_kategori]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">
                        Nama Kategori
                    </label>

                    <input
                        type="text"
                        name="nama_kategori"
                        id="nama_kategori"
                        class="form-control"
                        value="{{ $data->nama_kategori }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="kode_kategori" class="form-label">
                        Kode Kategori
                    </label>

                    <input
                        type="text"
                        name="kode_kategori"
                        id="kode_kategori"
                        class="form-control"
                        value="{{ $data->kode_kategori }}"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="form-label">
                        Keterangan
                    </label>

                    <input
                        type="text"
                        name="keterangan"
                        id="keterangan"
                        class="form-control"
                        value="{{ $data->keterangan }}"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-brand w-100">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Simpan Perubahan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection