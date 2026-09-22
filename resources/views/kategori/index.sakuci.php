@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    <style>
        :root {
            --brand-1: #4f8dff;
            --brand-2: #7c5cff;
            --hero-bg-light: radial-gradient(circle at 20% 20%, rgba(79,141,255,0.10), transparent 45%),
                              radial-gradient(circle at 80% 30%, rgba(124,92,255,0.10), transparent 45%);
            --hero-bg-dark: radial-gradient(circle at 20% 20%, rgba(79,141,255,0.18), transparent 45%),
                             radial-gradient(circle at 80% 30%, rgba(124,92,255,0.18), transparent 45%);
        }

        .hero-wrap {
            position: relative;
            border-radius: 1.5rem;
            overflow: hidden;
            padding: 2rem 1.5rem;
            background: var(--hero-bg-light);
            margin-bottom: 1.5rem;
        }

        .badge-brand {
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            color: #fff !important;
            font-weight: 600;
            letter-spacing: .03em;
            box-shadow: 0 4px 18px rgba(79,141,255,0.35);
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }
        .badge-brand::before {
            content: "🗂️";
            font-size: .9rem;
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
            box-shadow: 0 6px 20px rgba(79,141,255,0.35);
            transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
        }
        .btn-brand:hover,
        .btn-brand:focus {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 26px rgba(79,141,255,0.45);
            filter: brightness(1.05);
        }
        .btn-brand:active {
            transform: translateY(0);
        }

        .card-brand {
            border: none;
            border-radius: 1.2rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        }

        .table-brand thead {
            background: rgba(79,141,255,0.08);
        }
        .table-brand thead th {
            border-bottom: none;
            font-weight: 700;
            font-size: .85rem;
            text-transform: uppercase;
            letter-spacing: .03em;
            color: #4a4a4a;
        }
        .table-brand tbody tr {
            transition: background-color .15s ease;
        }
        .table-brand tbody tr:hover {
            background-color: rgba(79,141,255,0.05);
        }

        code.inline {
            background: rgba(127,127,127,0.12);
            padding: .2rem .55rem;
            border-radius: .5rem;
            font-size: .8rem;
            border: 1px solid rgba(127,127,127,0.18);
        }

        @media (prefers-color-scheme: dark) {
            .hero-wrap { background: var(--hero-bg-dark); }
            .card-brand { background: #1f1f23; }
            .table-brand thead { background: rgba(79,141,255,0.12); }
            .table-brand thead th { color: #d0d0d0; }
        }
        [data-bs-theme="dark"] .hero-wrap {
            background: var(--hero-bg-dark);
        }
        [data-bs-theme="dark"] .card-brand {
            background: #1f1f23;
        }
        [data-bs-theme="dark"] .table-brand thead {
            background: rgba(79,141,255,0.12);
        }
        [data-bs-theme="dark"] .table-brand thead th {
            color: #d0d0d0;
        }
    </style>

    {{-- Hero --}}
    <section class="text-center py-3 py-lg-4 hero-wrap">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">Manajemen Kategori</span>

        <h1 class="display-6 fw-bold mb-2">
            Daftar <span class="text-brand">Kategori</span>
        </h1>

        <p class="text-secondary mx-auto mb-3" style="max-width: 560px;">
            Kelola kategori alat/barang sekolah — tambah, ubah, atau hapus sesuai kebutuhan.
        </p>

        <a href="{{ route('kategori.create') }}" class="btn btn-brand px-4">+ Tambah Kategori</a>
    </section>

    {{-- Tabel --}}
    <div class="card card-brand p-3 p-lg-4">
        <div class="table-responsive">
            <table class="table table-sm table-brand align-middle mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($kategori as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><code class="inline">{{ $item->kode_kategori }}</code></td>
                            <td class="fw-semibold">{{ $item->nama_kategori }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td class="text-end">
                                <a href="{{ route('kategori.edit', ['id_kategori' => $item->id_kategori]) }}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{ route('kategori.destroy', ['id_kategori' => $item->id_kategori]) }}"
                                      method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {!! $kategori->links() !!}
    </div>
@endsection