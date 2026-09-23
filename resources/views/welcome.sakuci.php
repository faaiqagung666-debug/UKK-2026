@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    <style>
        :root {
            --brand-1: #4f8dff;
            --brand-2: #7c5cff;
            --hero-bg-light: radial-gradient(circle at 20% 20%, rgba(79,141,255,0.10), transparent 45%),
                            radial-gradient(circle at 80% 30%, rgba(124,92,255,0.10), transparent 45%);
            --hero-bg-dark: radial-gradient(circle at 20% 20%, rgba(79,141,255,0.15), transparent 45%),
                            radial-gradient(circle at 80% 30%, rgba(124,92,255,0.15), transparent 45%);
        }

        .hero-wrap {
            position: relative;
            border-radius: 1.8rem;
            overflow: hidden;
            padding: 4rem 1.5rem;
            background: var(--hero-bg-light);
            border: 1px solid rgba(0, 0, 0, 0.04);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            transition: background 0.3s ease, border-color 0.3s ease;
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
            content: "🛠️";
            font-size: .9rem;
        }

        .text-brand {
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        code.inline {
            background: rgba(127,127,127,0.12);
            padding: .2rem .55rem;
            border-radius: .5rem;
            font-size: .8rem;
            border: 1px solid rgba(127,127,127,0.18);
            color: inherit;
        }

        /* Support Otomatis untuk Dark Mode (Sistem & Bootstrap 5.3) */
        @media (prefers-color-scheme: dark) {
            .hero-wrap { 
                background: var(--hero-bg-dark); 
                border-color: rgba(255, 255, 255, 0.06);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }
        }

        [data-bs-theme="dark"] .hero-wrap {
            background: var(--hero-bg-dark);
            border-color: rgba(255, 255, 255, 0.06);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
    </style>

    {{-- Hero Section --}}
    <section class="text-center py-4 py-lg-5 hero-wrap my-3">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">Sistem Peminjaman Alat</span>

        <h1 class="display-5 fw-bold mb-3 text-body">
            Peminjaman Alat,<br class="d-none d-md-inline">
            <span class="text-brand">SMK SANGKURIANG 1</span>
        </h1>

        <p class="lead text-secondary mx-auto mb-4" style="max-width: 620px;">
            Alat merupakan salah satu fasilitas yang dibutuhkan dalam kegiatan belajar mengajar,
            berikut web untuk mempermudah peminjaman alat/barang sekolah.
        </p>

        <p class="text-secondary small mt-3 mb-0">
            <code class="inline">FAAIQ AGUNG NUGRAHA</code>
        </p>
    </section>

@endsection