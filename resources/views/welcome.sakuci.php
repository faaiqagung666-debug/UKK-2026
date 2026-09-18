@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    {{-- Hero --}}
    <section class="text-center py-4 py-lg-5">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">WELCOME</span>

        <h1 class="display-5 fw-bold mb-3">
            Peminjaman alat ,<br class="d-none d-md-inline">
            <span class="text-brand">SMK SANGKURIANG 1</span>
        </h1>

        <p class="lead text-secondary mx-auto mb-4" style="max-width: 620px;">
           Alat merupakan salah satu fasilitas yang dibutuhkan dalam kegiatan belajar mengajar,
           berikut web untuk mempermudah peminjaman alat/barang sekolah
        </p>

        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a class="btn btn-brand btn-lg px-4" href="{{ route('kategori.index') }}">Kategori</a>
            <a class="btn btn-brand btn-lg px-4" href="{{ route('alat.index') }}">Alat</a>
        </div>

        <p class="text-secondary small mt-3 mb-0">
            Web peminjaman alat sederhana
            <code class="inline">FAAIQ AGUNG NUGRAHA</code>
        </p>
    </section>
@endsection
