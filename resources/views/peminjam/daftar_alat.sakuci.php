@extends('layouts.app')

@section('title', 'Daftar Alat Tersedia')

@section('content')
<style>
    :root {
        --brand-1: #2563eb;
        --brand-2: #7c3aed;
        --brand-glow: rgba(37, 99, 235, 0.2);
    }

    /* Styling Card Alat ala Quick Action Card */
    .alat-card {
        border: 1px solid rgba(127, 127, 127, 0.12);
        border-radius: 1.25rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.02);
        transition: all 0.25s cubic-bezier(0.165, 0.84, 0.44, 1);
        color: inherit;
        background: var(--bs-body-bg);
        position: relative;
        overflow: hidden;
    }

    .alat-card::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .alat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        border-color: rgba(37, 99, 235, 0.3);
    }

    .alat-card:hover::after {
        opacity: 1;
    }

    .btn-brand-action {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        border: none;
        color: #ffffff;
        box-shadow: 0 4px 14px var(--brand-glow);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .btn-brand-action:hover {
        opacity: 0.95;
        transform: translateY(-1px);
        color: #ffffff;
    }

    /* Support Dark Mode Otomatis */
    [data-bs-theme="dark"] .alat-card {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
</style>

<div class="container-fluid py-4 px-4">

    <!-- Header & Fitur Pencarian -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1 text-body">Daftar Alat Tersedia</h3>
            <p class="text-body-secondary mb-0">Pilih alat yang ingin Anda ajukan untuk dipinjam.</p>
        </div>

        <!-- Form Pencarian -->
        <form action="{{ route('peminjam.alat') }}" method="GET" class="d-flex gap-2" style="max-width: 320px;">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Cari nama / kode alat..." value="{{ request('q') }}">
                <button class="btn btn-brand-action" type="submit">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Grid Card Daftar Alat -->
    <div class="row g-4">
        @forelse($alats as $item)
            @php
                $namaKategori = $kategoriMap[$item->id_kategori] ?? 'Umum';
            @endphp
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card alat-card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div>
                            <!-- Badge Kode Alat & Kategori -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-body-secondary text-body border px-2.5 py-1.5 fw-semibold" style="font-size: 0.75rem;">
                                    {{ $item->kode_alat }}
                                </span>
                                <span class="badge bg-body-secondary text-body border px-2.5 py-1.5 fw-semibold" style="font-size: 0.75rem;">
                                    {{ $namaKategori }}
                                </span>
                            </div>

                            <!-- Nama Alat -->
                            <h5 class="fw-bold fs-6 mb-2 text-body">
                                {{ $item->nama_alat }}
                            </h5>
                        </div>

                        <!-- Tombol Pinjam -->
                        <div class="mt-4 pt-3 border-top">
                            <a href="{{ route('peminjam.createPeminjam', ['id_alat' => $item->id_alat]) }}" 
                               class="btn btn-brand-action w-100 rounded-2 py-2 fw-medium d-flex align-items-center justify-content-center">
                                Ajukan Pinjam
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card alat-card border-0 shadow-sm p-5 text-center">
                    <h5 class="fw-bold text-body-secondary mb-0">Belum ada alat yang tersedia.</h5>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(method_exists($alats, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {!! $alats->links() !!}
        </div>
    @endif

</div>
@endsection