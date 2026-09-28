@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="h4 mb-0 fw-bold">Tambah Peminjaman Alat</h2>
    </div>

    <div class="card border shadow-sm rounded-4 overflow-hidden col-lg-8 mx-auto">
        <div class="card-body p-4">
            
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                
                {{-- Pilih User --}}
                <div class="mb-3">
                    <label for="id_user" class="form-label fw-semibold">Pilih User / Peminjam</label>
                    <select name="id_user" id="id_user" class="form-select" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id_user ?? $user->id }}">
                                {{ $user->nama ?? $user->name ?? $user->username }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Pilih Alat --}}
                <div class="mb-3">
                    <label for="id_alat" class="form-label fw-semibold">Pilih Alat</label>
                    <select name="id_alat" id="id_alat" class="form-select" required>
                        <option value="">-- Pilih Alat --</option>
                        @foreach($alat as $item)
                            <option value="{{ $item->id_alat ?? $item->id }}">
                                {{ $item->nama_alat ?? $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Jumlah --}}
                <div class="mb-3">
                    <label for="jumlah" class="form-label fw-semibold">Jumlah Unit</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" value="1" min="1" required>
                </div>

                {{-- Tanggal Pinjam --}}
                <div class="mb-3">
                    <label for="tanggal_pinjam" class="form-label fw-semibold">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                {{-- Tanggal Kembali --}}
                <div class="mb-3">
                    <label for="tanggal_kembali" class="form-label fw-semibold">Tanggal Kembali (Aktual)</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control">
                    <div class="form-text">Bisa dikosongkan jika alat belum dikembalikan.</div>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label fw-semibold">Status Peminjaman</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="Pending" selected>Pending</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Dipinjam">Dipinjam</option>
                        <option value="Dikembalikan">Dikembalikan</option>
                    </select>
                </div>

                {{-- Denda --}}
                <div class="mb-4">
                    <label for="denda" class="form-label fw-semibold">Denda (Rp)</label>
                    <input type="number" name="denda" id="denda" class="form-control" value="0" min="0">
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-light border px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Peminjaman</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection