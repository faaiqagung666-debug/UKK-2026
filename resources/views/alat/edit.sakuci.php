@extends('layouts.app')

@section('content')

<h1>edit alat</h1>
<form action="{{ route('alat.update', ['id_alat' => $alat->id_alat]) }}" method="POST" class="d-flex flex-column gap-2">
    @csrf
    @method('PUT')
        <label>Nama alat</label>
        <input type="text" name="nama_alat" id="nama_alat" value="{{ $alat->nama_alat }}" required>

       <div class="form-group mb-3">
            <label>kode alat</label>
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