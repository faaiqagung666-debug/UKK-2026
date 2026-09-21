t@extends('layouts.app')

@secion('content')

<h1>edit kategori</h1>
<form action="{{ route('kategori.update', ['id_kategori' => $data->id_kategori]) }}" method="POST" class="d-flex flex-column gap-2">
    @csrf
    @method('PUT')
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $data->nama_kategori }}" required>

        <label>Kode Kategori</label>
        <input type="text" name="kode_kategori" id="kode_kategori" value="{{ $data->kode_kategori }}" required>

        <label>Keterangan</label>
        <input type="text" name="keterangan" id="keterangan" value="{{ $data->keterangan }}" required>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection