@extends('layouts.app')

@section('title', config('app.name') . ' -- Manajemen Data Alat')

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

    .badge-kategori {
        background: rgba(124, 58, 237, 0.12);
        color: var(--brand-2);
        font-weight: 600;
        border-radius: .6rem;
        padding: .35rem .7rem;
        border: 1px solid rgba(124, 58, 237, 0.2);
    }

    code.inline {
        background: rgba(37, 99, 235, 0.1);
        color: var(--brand-1);
        padding: .25rem .6rem;
        border-radius: .5rem;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid rgba(37, 99, 235, 0.18);
    }

    /* Support Dark Mode Otomatis */
    [data-bs-theme="dark"] .hero-wrap {
        background: var(--hero-bg-dark);
        border-color: rgba(255, 255, 255, 0.08);
    }
    [data-bs-theme="dark"] code.inline {
        background: rgba(96, 165, 250, 0.15);
        color: #93c5fd;
        border-color: rgba(96, 165, 250, 0.25);
    }
    [data-bs-theme="dark"] .badge-kategori {
        background: rgba(167, 139, 250, 0.15);
        color: #c4b5fd;
        border-color: rgba(167, 139, 250, 0.25);
    }
</style>

<div class="container-fluid py-4 px-4">

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
            <i class="bi bi-tools me-1"></i> Inventaris Sarpras
        </span>

        <h1 class="display-6 fw-bold mb-2 text-body">
            Daftar <span class="text-brand">Alat Sekolah</span>
        </h1>

        <p class="text-body-secondary mx-auto mb-4" style="max-width: 560px;">
            Kelola data barang dan perangkat inventaris sekolah — tambah baru, perbarui data, atau hapus item sesuai kebutuhan.
        </p>

        <a href="{{ route('alat.create') }}" class="btn btn-brand px-4 py-2.5 d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Tambah Alat Baru</span>
        </a>
    </section>

    {{-- Card Tabel --}}
    <div class="card card-brand shadow-sm overflow-hidden mb-4">
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-box-seam text-primary fs-5"></i>
                <h6 class="fw-bold mb-0 text-body">Data Inventaris Alat</h6>
            </div>
            <span class="badge bg-body-tertiary text-body-secondary border px-3 py-1.5 rounded-pill small fw-normal">
                Total: {{ count($datal) }} Unit
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Nama Alat</th>
                            <th class="py-3 px-3">Kode Alat</th>
                            <th class="py-3 px-3">Kategori</th>
                            <th class="py-3 px-4 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @php $no = 1; @endphp
                        @forelse ($datal as $alats)
                            <tr>
                                <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                                <td class="px-3">
                                    <span class="fw-bold text-body fs-7">{{ $alats->nama_alat }}</span>
                                </td>
                                <td class="px-3">
                                    <code class="inline">#{{ $alats->kode_alat }}</code>
                                </td>
                                <td class="px-3">
                                    @php
                                        $namaKategori = '-';
                                        if (isset($alats->kategori)) {
                                            $namaKategori = $alats->kategori->nama_kategori;
                                        } else {
                                            foreach ($kategori as $k) {
                                                if ($k->id_kategori == $alats->id_kategori) {
                                                    $namaKategori = $k->nama_kategori;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                    <span class="badge-kategori fs-8">
                                        <i class="bi bi-tag-fill me-1 opacity-75"></i>{{ $namaKategori }}
                                    </span>
                                </td>
                                <td class="px-4 text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center gap-1.5">
                                        <a href="{{ route('alat.edit', ['alat' => $alats->id_alat]) }}" class="btn btn-sm btn-outline-warning fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7" title="Edit Data">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        
                                        <form action="{{ route('alat.delete', ['id' => $alats->id_alat]) }}" method="POST" class="d-inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7" onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?')" title="Hapus Data">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-body-secondary">
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <div class="bg-body-tertiary rounded-circle p-3 mb-1">
                                            <i class="bi bi-inbox text-body-secondary fs-2 opacity-50"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0 text-body">Belum Ada Data Alat</h6>
                                        <span class="fs-7 text-body-secondary">Silakan tambahkan data alat inventaris baru.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if(method_exists($datal, 'hasPages') && $datal->hasPages())
            <div class="card-footer bg-transparent py-3 border-top d-flex justify-content-end">
                {!! $datal->links() !!}
            </div>
        @endif
    </div>

</div>
@endsection@extends('layouts.app')

@section('title', config('app.name') . ' -- Manajemen Data Alat')

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

    .badge-kategori {
        background: rgba(124, 58, 237, 0.12);
        color: var(--brand-2);
        font-weight: 600;
        border-radius: .6rem;
        padding: .35rem .7rem;
        border: 1px solid rgba(124, 58, 237, 0.2);
    }

    code.inline {
        background: rgba(37, 99, 235, 0.1);
        color: var(--brand-1);
        padding: .25rem .6rem;
        border-radius: .5rem;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid rgba(37, 99, 235, 0.18);
    }

    /* Support Dark Mode Otomatis */
    [data-bs-theme="dark"] .hero-wrap {
        background: var(--hero-bg-dark);
        border-color: rgba(255, 255, 255, 0.08);
    }
    [data-bs-theme="dark"] code.inline {
        background: rgba(96, 165, 250, 0.15);
        color: #93c5fd;
        border-color: rgba(96, 165, 250, 0.25);
    }
    [data-bs-theme="dark"] .badge-kategori {
        background: rgba(167, 139, 250, 0.15);
        color: #c4b5fd;
        border-color: rgba(167, 139, 250, 0.25);
    }
</style>

<div class="container-fluid py-4 px-4">

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
            <i class="bi bi-tools me-1"></i> Inventaris Sarpras
        </span>

        <h1 class="display-6 fw-bold mb-2 text-body">
            Daftar <span class="text-brand">Alat Sekolah</span>
        </h1>

        <p class="text-body-secondary mx-auto mb-4" style="max-width: 560px;">
            Kelola data barang dan perangkat inventaris sekolah — tambah baru, perbarui data, atau hapus item sesuai kebutuhan.
        </p>

        <a href="{{ route('alat.create') }}" class="btn btn-brand px-4 py-2.5 d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Tambah Alat Baru</span>
        </a>
    </section>

    {{-- Card Tabel --}}
    <div class="card card-brand shadow-sm overflow-hidden mb-4">
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-box-seam text-primary fs-5"></i>
                <h6 class="fw-bold mb-0 text-body">Data Inventaris Alat</h6>
            </div>
            <span class="badge bg-body-tertiary text-body-secondary border px-3 py-1.5 rounded-pill small fw-normal">
                Total: {{ count($datal) }} Unit
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Nama Alat</th>
                            <th class="py-3 px-3">Kode Alat</th>
                            <th class="py-3 px-3">Kategori</th>
                            <th class="py-3 px-4 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @php $no = 1; @endphp
                        @forelse ($datal as $alats)
                            <tr>
                                <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                                <td class="px-3">
                                    <span class="fw-bold text-body fs-7">{{ $alats->nama_alat }}</span>
                                </td>
                                <td class="px-3">
                                    <code class="inline">#{{ $alats->kode_alat }}</code>
                                </td>
                                <td class="px-3">
                                    @php
                                        $namaKategori = '-';
                                        if (isset($alats->kategori)) {
                                            $namaKategori = $alats->kategori->nama_kategori;
                                        } else {
                                            foreach ($kategori as $k) {
                                                if ($k->id_kategori == $alats->id_kategori) {
                                                    $namaKategori = $k->nama_kategori;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                    <span class="badge-kategori fs-8">
                                        <i class="bi bi-tag-fill me-1 opacity-75"></i>{{ $namaKategori }}
                                    </span>
                                </td>
                                <td class="px-4 text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center gap-1.5">
                                        <a href="{{ route('alat.edit', ['alat' => $alats->id_alat]) }}" class="btn btn-sm btn-outline-warning fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7" title="Edit Data">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        
                                        <form action="{{ route('alat.delete', ['id' => $alats->id_alat]) }}" method="POST" class="d-inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7" onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?')" title="Hapus Data">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-body-secondary">
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <div class="bg-body-tertiary rounded-circle p-3 mb-1">
                                            <i class="bi bi-inbox text-body-secondary fs-2 opacity-50"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0 text-body">Belum Ada Data Alat</h6>
                                        <span class="fs-7 text-body-secondary">Silakan tambahkan data alat inventaris baru.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if(method_exists($datal, 'hasPages') && $datal->hasPages())
            <div class="card-footer bg-transparent py-3 border-top d-flex justify-content-end">
                {!! $datal->links() !!}
            </div>
        @endif
    </div>

</div>
@endsection@extends('layouts.app')

@section('title', config('app.name') . ' -- Manajemen Data Alat')

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

    .badge-kategori {
        background: rgba(124, 58, 237, 0.12);
        color: var(--brand-2);
        font-weight: 600;
        border-radius: .6rem;
        padding: .35rem .7rem;
        border: 1px solid rgba(124, 58, 237, 0.2);
    }

    code.inline {
        background: rgba(37, 99, 235, 0.1);
        color: var(--brand-1);
        padding: .25rem .6rem;
        border-radius: .5rem;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid rgba(37, 99, 235, 0.18);
    }

    /* Support Dark Mode Otomatis */
    [data-bs-theme="dark"] .hero-wrap {
        background: var(--hero-bg-dark);
        border-color: rgba(255, 255, 255, 0.08);
    }
    [data-bs-theme="dark"] code.inline {
        background: rgba(96, 165, 250, 0.15);
        color: #93c5fd;
        border-color: rgba(96, 165, 250, 0.25);
    }
    [data-bs-theme="dark"] .badge-kategori {
        background: rgba(167, 139, 250, 0.15);
        color: #c4b5fd;
        border-color: rgba(167, 139, 250, 0.25);
    }
</style>

<div class="container-fluid py-4 px-4">

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
            <i class="bi bi-tools me-1"></i> Inventaris Sarpras
        </span>

        <h1 class="display-6 fw-bold mb-2 text-body">
            Daftar <span class="text-brand">Alat Sekolah</span>
        </h1>

        <p class="text-body-secondary mx-auto mb-4" style="max-width: 560px;">
            Kelola data barang dan perangkat inventaris sekolah — tambah baru, perbarui data, atau hapus item sesuai kebutuhan.
        </p>

        <a href="{{ route('alat.create') }}" class="btn btn-brand px-4 py-2.5 d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Tambah Alat Baru</span>
        </a>
    </section>

    {{-- Card Tabel --}}
    <div class="card card-brand shadow-sm overflow-hidden mb-4">
        <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-box-seam text-primary fs-5"></i>
                <h6 class="fw-bold mb-0 text-body">Data Inventaris Alat</h6>
            </div>
            <span class="badge bg-body-tertiary text-body-secondary border px-3 py-1.5 rounded-pill small fw-normal">
                Total: {{ count($datal) }} Unit
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Nama Alat</th>
                            <th class="py-3 px-3">Kode Alat</th>
                            <th class="py-3 px-3">Kategori</th>
                            <th class="py-3 px-4 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @php $no = 1; @endphp
                        @forelse ($datal as $alats)
                            <tr>
                                <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                                <td class="px-3">
                                    <span class="fw-bold text-body fs-7">{{ $alats->nama_alat }}</span>
                                </td>
                                <td class="px-3">
                                    <code class="inline">#{{ $alats->kode_alat }}</code>
                                </td>
                                <td class="px-3">
                                    @php
                                        $namaKategori = '-';
                                        if (isset($alats->kategori)) {
                                            $namaKategori = $alats->kategori->nama_kategori;
                                        } else {
                                            foreach ($kategori as $k) {
                                                if ($k->id_kategori == $alats->id_kategori) {
                                                    $namaKategori = $k->nama_kategori;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                    <span class="badge-kategori fs-8">
                                        <i class="bi bi-tag-fill me-1 opacity-75"></i>{{ $namaKategori }}
                                    </span>
                                </td>
                                <td class="px-4 text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center gap-1.5">
                                        <a href="{{ route('alat.edit', ['alat' => $alats->id_alat]) }}" class="btn btn-sm btn-outline-warning fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7" title="Edit Data">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        
                                        <form action="{{ route('alat.delete', ['id' => $alats->id_alat]) }}" method="POST" class="d-inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger fw-medium px-2.5 py-1 rounded-2 d-inline-flex align-items-center gap-1 fs-7" onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?')" title="Hapus Data">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-body-secondary">
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <div class="bg-body-tertiary rounded-circle p-3 mb-1">
                                            <i class="bi bi-inbox text-body-secondary fs-2 opacity-50"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0 text-body">Belum Ada Data Alat</h6>
                                        <span class="fs-7 text-body-secondary">Silakan tambahkan data alat inventaris baru.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if(method_exists($datal, 'hasPages') && $datal->hasPages())
            <div class="card-footer bg-transparent py-3 border-top d-flex justify-content-end">
                {!! $datal->links() !!}
            </div>
        @endif
    </div>

</div>
@endsection