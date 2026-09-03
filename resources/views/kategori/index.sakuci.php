@extends('layouts.app')

@section('content')

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th >no</th>
            <th >Kode Kategori</th>
            <th >Nama Kategori</th>
            <th >Keterangan</th>
            <th >Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($kategori as $item)
            <tr>
                <td>{{ $no++}}</td>
                <td>{{ $item->kode_kategori }}</td>
                <td>{{ $item->nama_kategori }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    <a href="" class="btn btn-sm btn-primary">Edit</a>
                    <a href="" class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{!! $kategori->links() !!}
@endsection