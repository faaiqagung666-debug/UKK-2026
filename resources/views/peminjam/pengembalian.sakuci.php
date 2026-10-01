@extends('layouts.app')

@section('title', config('app.name') . ' -- Pengembalian Alat')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,600;12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.20);
        --brand-border: rgba(13, 122, 80, 0.18);
    }

    /* =========================
       BASE
    ========================= */
    .pengembalian-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .pengembalian-page h1,
    .pengembalian-page h2,
    .pengembalian-page h3,
    .pengembalian-page h4,
    .pengembalian-page h5,
    .pengembalian-page h6 {
        font-family: 'Bricolage Grotesque', sans-serif;
    }

    .tracking-tight {
        letter-spacing: -0.025em;
    }

    /* =========================
       HEADER
    ========================= */
    .pengembalian-header {
        animation: fadeUp .55s ease both;
    }

    .pengembalian-header h3 {
        font-weight: 800;
        letter-spacing: -0.025em;
    }

    /* =========================
       ALERT
    ========================= */
    .pengembalian-page .alert {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        animation: slideDown .45s ease both;
    }

    /* =========================
       MAIN CARD
    ========================= */
    .pengembalian-card {
        border: 1px solid var(--brand-border);
        border-radius: 1.25rem !important;
        background: var(--bs-body-bg);
        box-shadow: 0 6px 22px rgba(0, 0, 0, 0.035) !important;
        overflow: hidden;
        animation: fadeUp .6s ease both;
    }

    /* =========================
       TABLE
    ========================= */
    .pengembalian-card table thead {
        background: rgba(13, 122, 80, 0.045) !important;
    }

    .pengembalian-card table tbody tr {
        transition: background .2s ease;
    }

    .pengembalian-card table tbody tr:hover {
        background: rgba(13, 122, 80, 0.045);
    }

    .pengembalian-card table tbody tr td:first-child {
        position: relative;
    }

    .pengembalian-card table tbody tr:hover td:first-child::before {
        content: "";
        position: absolute;
        left: 0;
        top: 12%;
        bottom: 12%;
        width: 3px;
        border-radius: 0 4px 4px 0;
        background: var(--brand-1);
    }

    /* =========================
       STATUS
    ========================= */
    .pengembalian-page .bg-primary-subtle {
        background-color: rgba(13, 122, 80, 0.10) !important;
    }

    .pengembalian-page .text-primary-emphasis {
        color: var(--brand-2) !important;
    }

    /* =========================
       FORM PENGEMBALIAN
    ========================= */
    .return-form {
        min-width: 230px;
        border-color: var(--brand-border) !important;
        border-radius: .8rem !important;
        transition: all .25s ease;
    }

    .return-form:hover {
        border-color: rgba(13, 122, 80, 0.30) !important;
        box-shadow: 0 5px 16px rgba(13, 122, 80, 0.07);
    }

    .return-form .form-label {
        color: var(--bs-secondary-color);
    }

    .return-form .form-select {
        border-color: rgba(127, 127, 127, 0.18);
        border-radius: .6rem;
        box-shadow: none;
        transition: all .2s ease;
    }

    .return-form .form-select:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem rgba(13, 122, 80, 0.10);
    }

    .return-form .btn-success {
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        ) !important;
        border: none !important;
        color: #fff !important;
        border-radius: .6rem;
        box-shadow: 0 4px 12px var(--brand-glow);
        transition: all .2s ease;
    }

    .return-form .btn-success:hover {
        background: linear-gradient(
            135deg,
            var(--brand-2),
            var(--brand-1)
        ) !important;
        transform: translateY(-1px);
        box-shadow: 0 7px 18px rgba(13, 122, 80, 0.22);
    }

    /* =========================
       EMPTY STATE
    ========================= */
    .empty-return {
        animation: fadeUp .6s ease both;
    }

    .empty-return .bi-check-circle {
        color: var(--brand-1) !important;
    }

    .empty-return-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: rgba(13, 122, 80, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* =========================
       PAGINATION
    ========================= */
    .pengembalian-card .card-footer {
        border-top: 1px solid var(--brand-border) !important;
    }

    .pengembalian-card .pagination .page-link {
        color: var(--brand-1);
        border-color: rgba(13, 122, 80, 0.15);
    }

    .pengembalian-card .pagination .page-item.active .page-link {
        background-color: var(--brand-1);
        border-color: var(--brand-1);
        color: #fff;
    }

    .pengembalian-card .pagination .page-link:hover {
        background-color: rgba(13, 122, 80, 0.08);
        border-color: rgba(13, 122, 80, 0.25);
    }

    /* =========================
       DARK MODE
    ========================= */
    [data-bs-theme="dark"] .pengembalian-card {
        border-color: rgba(255, 255, 255, 0.08);
        background: rgba(255, 255, 255, 0.02);
    }

    [data-bs-theme="dark"] .pengembalian-card table thead {
        background: rgba(255, 255, 255, 0.025) !important;
    }

    [data-bs-theme="dark"] .pengembalian-card table tbody tr:hover {
        background: rgba(13, 122, 80, 0.08);
    }

    [data-bs-theme="dark"] .return-form {
        border-color: rgba(255, 255, 255, 0.10) !important;
    }

    [data-bs-theme="dark"] .return-form:hover {
        border-color: rgba(217, 242, 75, 0.20) !important;
    }

    [data-bs-theme="dark"] .empty-return-icon {
        background: rgba(217, 242, 75, 0.08);
    }

    /* =========================
       ANIMATION
    ========================= */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .pengembalian-card {
            border-radius: 1rem !important;
        }

        .pengembalian-header h3 {
            font-size: 1.4rem;
        }

        .return-form {
            min-width: 200px;
        }
    }
</style>

<div class="container-fluid py-4 px-4 pengembalian-page">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3 pengembalian-header">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight">Pengembalian Alat</h3>
            <p class="text-body-secondary small mb-0">
                Daftar alat aktif yang sedang Anda pinjam dan siap untuk dikembalikan.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden pengembalian-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Nama Alat</th>
                            <th class="py-3 px-3">Jumlah</th>
                            <th class="py-3 px-3">Tgl Pinjam</th>
                            <th class="py-3 px-3">Status Saat Ini</th>
                            <th class="py-3 px-3 text-center">Aksi & Kondisi Pengembalian</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $no = 1; @endphp

                        @forelse ($datap as $peminjaman)
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">
                                {{ $no++ }}
                            </td>

                            <td class="px-3">
                                <div class="fw-semibold text-body fs-7">
                                    {{ $peminjaman->alat->nama_alat ?? $peminjaman->alat->nama ?? 'Alat ID: ' . $peminjaman->id_alat }}
                                </div>
                            </td>

                            <td class="px-3">
                                <span class="badge bg-body-tertiary text-body border font-monospace fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                    {{ $peminjaman->jumlah }} Unit
                                </span>
                            </td>

                            <td class="px-3">
                                <span class="text-body-secondary fs-7">
                                    {{ $peminjaman->tanggal_pinjam }}
                                </span>
                            </td>

                            <td class="px-3">
                                <span class="badge bg-primary-subtle text-primary-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                    {{ $peminjaman->status }}
                                </span>
                            </td>

                            <td class="px-3 text-center">
                                <form action="{{ route('peminjam.pengembalian.store', ['id' => $peminjaman->id_peminjaman]) }}"
                                      method="POST"
                                      class="d-inline-block text-start p-2 border rounded bg-body-tertiary return-form">

                                    @csrf

                                    <div class="mb-2">
                                        <label class="form-label fs-9 mb-0 fw-bold">
                                            Pilih Kondisi Alat:
                                        </label>

                                        <select name="kondisi_barang" class="form-select form-select-sm fs-8">
                                            <option value="Baik">
                                                Baik (Denda: Rp 0)
                                            </option>

                                            <option value="Rusak Ringan">
                                                Rusak Ringan (Denda: Rp 10.000)
                                            </option>

                                            <option value="Rusak Berat">
                                                Rusak Berat (Denda: Rp 50.000)
                                            </option>
                                        </select>
                                    </div>

                                    <button type="submit"
                                            class="btn btn-sm btn-success w-100 fs-8 py-1">
                                        Konfirmasi Pengembalian
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center py-5 text-body-secondary">
                                <div class="d-flex flex-column align-items-center gap-2 empty-return">
                                    <div class="empty-return-icon">
                                        <i class="bi bi-check-circle fs-2 opacity-75 text-success"></i>
                                    </div>

                                    <span class="fs-7">
                                        Tidak ada alat yang sedang Anda pinjam saat ini.
                                    </span>
                                </div>
                            </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer bg-transparent py-3 border-top-0 d-flex justify-content-end">
            {!! $datap->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection