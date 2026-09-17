@extends('layouts.app')

@section('content')

<h1>edit alat</h1>
<form action="{{ route('alat.update', ['id_alat' => $alat->id_alat]) }}" method="POST" class="d-flex flex-column gap-2">
    @csrf
    @method('PUT')
        <label>Nama alat</label>
        <input type="text" name="nama_alat" id="nama_alat" value="{{ $alat->nama_alat }}" required>

        <label>Kode alat</label>
        <input type="text" name="kode_alat" id="kode_alat" value="{{ $alat->kode_alat }}" required>

    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection