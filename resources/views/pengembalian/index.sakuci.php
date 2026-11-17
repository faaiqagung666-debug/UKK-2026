@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Pengembalian Alat')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --font-display: 'Bricolage Grotesque', 'Plus Jakarta Sans', system-ui, sans-serif;
        --font-body: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
    }

    .pengembalian-page {
        font-family: var(--font-body);
    }

    .pengembalian-page .fs-7 { font-size: 0.88rem !important; }
    .pengembalian-page .fs-8 { font-size: 0.75rem !important; }
    .pengembalian-page .tracking-wider { letter-spacing: 0.06em; }

    .hero-wrap {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        isolation: isolate;
        padding: 2.75rem 1.5rem;
        background: radial-gradient(60% 90% at 100% 0%, rgba(217, 242, 75, 0.16) 0%, rgba(217, 242, 75, 0) 60%), linear-gradient(145deg, #0d7a50 0%, #075c3f 42%, #08211b 100%);
        border: 1px solid rgba(255, 255, 255, 0.14);
        box-shadow: 0 24px 48px -22px rgba(6, 78, 59, 0.55) !important;
    }

    .hero-wrap h1 {
        font-family: var(--font-display);
        font-weight: 800 !important;
        letter-spacing: -0.025em;
        color: #ffffff !important;
    }

    .hero-wrap h1 .text-brand {
        color: var(--whistle) !important;
    }

    .hero-wrap .badge-brand {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--whistle) !important;
        color: #052e24 !important;
        font-weight: 800;
        letter-spacing: .03em;
        border: 1px solid rgba(255, 255, 255, 0.35);
    }

    .text-brand {
        color: var(--whistle) !important;
    }

    .btn-brand {
        position: relative;
        overflow: hidden;
        background: #ffffff;
        border: 2px solid #ffffff;
        color: var(--brand-2);
        font-weight: 700;
        border-radius: 999px;
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.25);
        transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease, border-color .2s ease;
    }

    .btn-brand:hover {
        color: #0a2a22;
        background: var(--whistle);
        border-color: var(--whistle);
        transform: translateY(-2px);
    }

    .pengembalian-page .card-brand {
        border: 1px solid var(--bs-border-color-translucent);
        border-radius: 1.2rem;
        background: var(--bs-body-bg);
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 14px 30px -20px rgba(6, 78, 59, 0.25) !important;
    }

    .pengembalian-page .card-brand .card-header {
        background: transparent !important;
        border-bottom: 1px solid var(--bs-border-color);
        padding: 1rem 1.5rem !important;
    }

    .pengembalian-page .table {
        --bs-table-hover-bg: rgba(13, 122, 80, 0.06);
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

<div class="pengembalian-page container-fluid py-4 px-4">

    {{-- Alert Notifikasi Sukses --}}
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
            <i class="bi bi-arrow-return-left me-1"></i> Transaksi Pengembalian
        </span>

        <h1 class="display-6 fw-bold mb-2 text-body">
            Daftar <span class="text-brand">Pengembalian Alat Oahraga</span>
        </h1>

        <p class="text-body-secondary mx-auto mb-4" style="max-width: 560px;">
            Kelola riwayat pengembalian inventaris alat Olahraga, pinalti/denda, dan pengecekan kondisi barang secara transparan.
        </p>

        <a href="{{ route('pengembalian.create') }}" class="btn btn-brand px-4 py-2.5 d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Tambah Pengembalian Baru</span>
        </a>
    </section>

    {{-- Card Pembungkus Tabel --}}
    <div class="card card-brand shadow-sm overflow-hidden mb-4">
        
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-journal-check text-primary fs-5"></i>
                <h6 class="fw-bold mb-0 text-body">Data Transaksi Pengembalian</h6>
            </div>

            <span class="badge bg-body-tertiary text-body-secondary border px-3 py-1.5 rounded-pill small fw-normal">
                Total: {{ $datap->total() }} Data
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
                            <th class="py-3 px-4 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @php $no = 1; @endphp
                        @forelse ($datap as $pengembalian)
                            <tr>
                                {{-- NO --}}
                                <td class="px-4 text-center text-body-secondary fw-medium fs-7">
                                    {{ $no++ }}
                                </td>

                                {{-- NAMA PEMINJAM --}}
                                <td class="px-3">
                                    <span class="badge badge-name fw-bold px-2.5 py-1.5 rounded-2 fs-8">
                                        <i class="bi bi-person me-1"></i>
                                        @php
                                            // Mengambil relasi bertingkat pengembalian -> peminjaman -> user
                                            $user = $pengembalian->peminjaman->user ?? null;
                                            
                                            // Mencari nama user berdasarkan kolom yang tersedia di database
                                            $namaPeminjam = $user->name ?? $user->nama ?? $user->username ?? null;
                                            
                                            // Jika tetap tidak ditemukan, tampilkan ID peminjaman
                                            if (!$namaPeminjam) {
                                                $namaPeminjam = 'Peminjaman #' . ($pengembalian->id_peminjaman ?? '-');
                                            }
                                        @endphp
                                        {{ $namaPeminjam }}
                                    </span>
                                </td>

                                {{-- TANGGAL --}}
                                <td class="px-3">
                                    <span class="text-body-secondary fs-7">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ $pengembalian->tanggal_pengembalian }}
                                    </span>
                                </td>

                                {{-- KETERLAMBATAN --}}
                                <td class="px-3">
                                    @if($pengembalian->terlambat_hari > 0)
                                        <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                            {{ $pengembalian->terlambat_hari }} Hari
                                        </span>
                                    @else
                                        <span class="badge bg-success-subtle text-success border border-success border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-pill fs-8">
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                            Tepat Waktu
                                        </span>
                                    @endif
                                </td>

                                {{-- DENDA --}}
                                <td class="px-3">
                                    @if(($pengembalian->denda ?? 0) > 0)
                                        <span class="text-danger fw-bold fs-7">
                                            Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-body-secondary fs-7">Rp 0</span>
                                    @endif
                                </td>

                                {{-- KONDISI BARANG --}}
                                <td class="px-3">
                                    @php
                                        $kondisi = strtolower($pengembalian->kondisi_barang ?? 'baik');
                                    @endphp

                                    @if(str_contains($kondisi, 'baik'))
                                        <span class="badge bg-success-subtle text-success border border-success border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                            <i class="bi bi-check-lg me-1"></i>
                                            {{ $pengembalian->kondisi_barang ?? 'Baik' }}
                                        </span>
                                    @elseif(str_contains($kondisi, 'rusak'))
                                        <span class="badge bg-warning-subtle text-warning border border-warning border-opacity-25 fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                            <i class="bi bi-tools me-1"></i>
                                            {{ $pengembalian->kondisi_barang }}
                                        </span>
                                    @else
                                        <span class="badge bg-body-tertiary text-body border fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                            {{ $pengembalian->kondisi_barang ?? 'Baik' }}
                                        </span>
                                    @endif
                                </td>

                                {{-- CATATAN --}}
                                <td class="px-3">
                                    <span class="text-body-secondary text-truncate d-inline-block fs-7"
                                          style="max-width: 180px;"
                                          title="{{ $pengembalian->catatan }}">
                                        {{ $pengembalian->catatan ?? '-' }}
                                    </span>
                                </td>

                                {{-- AKSI --}}
                                <td class="px-4 text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center gap-1.5">
                                        <a href="{{ route('pengembalian.edit', ['id_pengembalian' => $pengembalian->id_pengembalian]) }}"
                                           class="btn btn-sm btn-outline-warning fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                           title="Edit Pengembalian">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <form action="{{ route('pengembalian.delete', ['id_pengembalian' => $pengembalian->id_pengembalian]) }}"
                                              method="POST"
                                              class="d-inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data pengembalian ini?')"
                                                    title="Hapus Data">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-body-secondary">
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <div class="bg-body-tertiary rounded-circle p-3 mb-1">
                                            <i class="bi bi-inbox text-body-secondary fs-2 opacity-50"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0 text-body">Belum Ada Data Pengembalian</h6>
                                        <span class="fs-7 text-body-secondary">Data pengembalian alat yang ditambahkan akan muncul di sini.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Bagian Pagination --}}
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
            <div class="card-footer bg-transparent py-3 border-top d-flex justify-content-end">
                {!! $datap->links() !!}
            </div>
        @endif

    </div>

</div>

@endsection