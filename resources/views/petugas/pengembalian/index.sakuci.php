@extends('layouts.app')

@section('title', config('app.name') . ' -- Pantau Pengembalian Alat')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.22);
    }

    .hero-wrap {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        padding: 2.5rem 1.5rem;
        background: linear-gradient(145deg, #0d7a50 0%, #064e3b 100%);
        color: #fff;
    }

    .badge-brand {
        background: var(--whistle);
        color: #064e3b;
        font-weight: 700;
    }

    .card-brand {
        border: 1px solid rgba(13, 122, 80, 0.12);
        border-radius: 1.2rem;
        background: var(--bs-body-bg);
    }

    .badge-name {
        background: rgba(13, 122, 80, 0.08);
        color: var(--brand-1);
        border: 1px solid rgba(13, 122, 80, 0.18) !important;
    }

    [data-bs-theme="dark"] .badge-name {
        background: rgba(217, 242, 75, 0.08);
        color: var(--whistle);
        border-color: rgba(217, 242, 75, 0.18) !important;
    }
</style>

<div class="container-fluid py-4 px-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                <div class="small fw-medium">{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Hero Section --}}
    <section class="text-center hero-wrap mb-4 shadow-sm">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
            <i class="bi bi-shield-check me-1"></i> Panel Petugas
        </span>
        <h1 class="display-6 fw-bold mb-2">Pantau Pengembalian Alat</h1>
        <p class="text-white-50 mx-auto mb-0" style="max-width: 560px;">
            Pantau seluruh data transaksi pengembalian alat inventaris yang masuk secara real-time.
        </p>
    </section>

    {{-- Tabel Pengembalian --}}
    <div class="card card-brand shadow-sm overflow-hidden mb-4">
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-journal-check text-primary fs-5"></i>
                <h6 class="fw-bold mb-0 text-body">Daftar Pemantauan Pengembalian</h6>
            </div>
            <span class="badge bg-body-tertiary text-body-secondary border px-3 py-1.5 rounded-pill small fw-normal">
                Total: {{ method_exists($datap, 'total') ? $datap->total() : count($datap) }} Data
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Nama Peminjam</th>
                            <th class="py-3 px-3">Tgl Pengembalian</th>
                            <th class="py-3 px-3">Keterlambatan</th>
                            <th class="py-3 px-3">Denda</th>
                            <th class="py-3 px-3">Kondisi Barang</th>
                            <th class="py-3 px-3">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @php $no = 1; @endphp
                        @forelse ($datap as $pengembalian)
                            <tr>
                                <td class="px-4 text-center text-body-secondary fw-medium fs-7">
                                    {{ $no++ }}
                                </td>

                                {{-- Nama Peminjam --}}
                                <td class="px-3">
                                    <span class="badge badge-name fw-bold px-2.5 py-1.5 rounded-2 fs-8">
                                        <i class="bi bi-person me-1"></i>
                                        @php
                                            $user = $pengembalian->peminjaman->user ?? null;
                                            $namaPeminjam = $user->username ?? $user->nama ?? $user->name ?? ('Peminjam #' . $pengembalian->id_peminjaman);
                                        @endphp
                                        {{ $namaPeminjam }}
                                    </span>
                                </td>

                                <td class="px-3">
                                    <span class="text-body-secondary fs-7">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ $pengembalian->tanggal_pengembalian }}
                                    </span>
                                </td>

                                <td class="px-3">
                                    @if(($pengembalian->terlambat_hari ?? 0) > 0)
                                        <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                            {{ $pengembalian->terlambat_hari }} Hari
                                        </span>
                                    @else
                                        <span class="badge bg-success-subtle text-success border border-success border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                            Tepat Waktu
                                        </span>
                                    @endif
                                </td>

                                <td class="px-3">
                                    @if(($pengembalian->denda ?? 0) > 0)
                                        <span class="text-danger fw-bold fs-7">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-body-secondary fs-7">Rp 0</span>
                                    @endif
                                </td>

                                <td class="px-3">
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                        {{ $pengembalian->kondisi_barang ?? 'Baik' }}
                                    </span>
                                </td>

                                <td class="px-3">
                                    <span class="text-body-secondary fs-7 text-truncate d-inline-block" style="max-width: 180px;">
                                        {{ $pengembalian->catatan ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-body-secondary">
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <i class="bi bi-inbox fs-2 opacity-50"></i>
                                        <h6 class="fw-bold mb-0">Belum Ada Data Pengembalian</h6>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
            <div class="card-footer bg-transparent py-3 border-top d-flex justify-content-end">
                {!! $datap->links() !!}
            </div>
        @endif
    </div>

</div>
@endsection