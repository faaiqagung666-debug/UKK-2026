@extends('layouts.app')

@section('content')

<h1>Tambah alat</h1>
<form action="{{ route('alat.store') }}" method="POST" class="d-flex flex-column gap-2">
    @csrf
        <label>Nama alat</label>
        <input type="text" name="nama_alat" id="nama_alat" class="form-control" value="{{ old('nama_alat') }}" required>

        <label>Kode alat</label>
        <input type="text" name="kode_alat" id="kode_alat" class="form-control" value="{{ old('kode_alat') }}" required>

        <div class="form-group mb-3">
            <label>Kategori</label>
            <select name="id_kategori" id="id_kategori" class="form-control" required>
                <option value="">Pilih Disini</option>

                @foreach($daftarKategori as $kat)
                    <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection