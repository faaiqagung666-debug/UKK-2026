@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar alat</h1>
    <a href="{{ route('alat.create') }}" class="btn btn-primary mb-3">Tambah alat</a>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th >no</th>
            <th >Kode alat</th>
            <th >Nama alat</th>
            <th >Kategori</th>
            <th >Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($alat as $item)
            <tr>
                <td>{{ $no++}}</td>
                <td>{{ $item->kode_alat }}</td>
                <td>{{ $item->nama_alat }}</td>
                 <td>{{ $item->Kategori }}</td>
                <td>
                    <a href="{{ route('alat.edit', ['id_alat' => $item->id_alat]) }}" class="btn btn-sm btn-primary">Edit</a>
                    
                    <form action="{{ route('alat.destroy', ['id_alat' => $item->id_alat]) }}"
                     method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">Hapus</button>
                        </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{!! $alat->links() !!}
@endsection