<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="window.print()">
    <div class="container mt-4">
        <h3 class="text-center mb-1">Laporan Peminjaman Alat</h3>
        <p class="text-center text-muted mb-4">Sistem Informasi Peminjaman Alat</p>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID User</th>
                    <th>ID Alat</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datap as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->id_user }}</td>
                    <td>{{ $p->id_alat }}</td>
                    <td>{{ $p->jumlah }}</td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->tanggal_kembali }}</td>
                    <td>{{ $p->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>