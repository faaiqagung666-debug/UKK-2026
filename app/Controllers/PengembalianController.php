<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\alat;

class PengembalianController extends Controller
{
    // ==========================================
    // BAGIAN ADMIN: Kelola Semua Pengembalian
    // ==========================================

    public function index(Request $request)
    {
        $datap = Pengembalian::orderBy('id_pengembalian', 'desc')->paginate(10);

        $peminjaman = Peminjaman::all();
        $users = User::all();
        $alats = Alat::all();

        $peminjamanList = [];
        foreach ($peminjaman as $p) {
            $pid = $p->id_peminjaman ?? $p->id;
            $peminjamanList[$pid] = $p;
        }

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('pengembalian.index', compact('datap', 'peminjamanList', 'userList', 'alatList'));
    }

    public function create(Request $request)
    {
        $peminjaman = Peminjaman::where('status', '!=', 'Dikembalikan')->get();
        $users = User::all();
        $alats = Alat::all();

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('pengembalian.create', compact('peminjaman', 'userList', 'alatList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'terlambat_hari'       => 'nullable|integer|min:0',
            'denda'                => 'nullable|integer|min:0',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $validatedData['terlambat_hari'] = $validatedData['terlambat_hari'] ?? 0;
        $validatedData['denda']          = $validatedData['denda'] ?? 0;
        $validatedData['kondisi_barang'] = $validatedData['kondisi_barang'] ?? 'Baik';

        Pengembalian::create($validatedData);

        $peminjaman = Peminjaman::findOrFail($validatedData['id_peminjaman']);
        $peminjaman->update(['status' => 'Dikembalikan']);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil ditambahkan.');
    }

    public function edit(Request $request, $id_pengembalian)
    {
        $datap = Pengembalian::findOrFail($id_pengembalian);
        $peminjaman = Peminjaman::find($datap->id_peminjaman);

        $peminjamName = '-';
        $alatName = '-';

        if ($peminjaman) {
            $user = User::find($peminjaman->id_user);
            $alat = Alat::find($peminjaman->id_alat);
            if (!$alat) {
                $alat = Alat::where('id_alat', $peminjaman->id_alat)->first();
            }

            $peminjamName = $user->username ?? $user->nama ?? ("User #" . $peminjaman->id_user);
            $alatName = $alat->nama_alat ?? ("Alat #" . $peminjaman->id_alat);
        }

        return view('pengembalian.edit', compact('datap', 'peminjaman', 'peminjamName', 'alatName'));
    }

    public function update(Request $request, $id_pengembalian)
    {
        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'terlambat_hari'       => 'nullable|integer|min:0',
            'denda'                => 'nullable|integer|min:0',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $pengembalian->update($validatedData);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil diubah.');
    }

    public function delete(Request $request, $id_pengembalian)
    {
        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $pengembalian->delete();

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil dihapus.');
    }

    // ==========================================
    // BAGIAN PETUGAS: Hanya Memantau Pengembalian
    // ==========================================

    public function indexPetugas(Request $request)
    {
        $datap = Pengembalian::orderBy('id_pengembalian', 'desc')->paginate(10);
        return view('petugas.pengembalian.index', compact('datap'));
    }

    // ==========================================
    // HALAMAN KHUSUS PEMINJAM: Pengembalian Alat
    // ==========================================

    public function indexPeminjamPengembalian(Request $request)
    {
        $currentUser = User::current();
        if (!$currentUser) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil peminjaman milik user yang statusnya masih Disetujui atau Dipinjam (belum dikembalikan)
        $datap = Peminjaman::where('id_user', $currentUser->id)
            ->whereIn('status', ['Disetujui', 'Dipinjam'])
            ->orderBy('id_peminjaman', 'desc')
            ->paginate(5);

        return view('peminjam.pengembalian', compact('datap'));
    }

    public function storePeminjamPengembalian(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();
        if (!$peminjaman) {
            return redirect(route('peminjam.pengembalian'))->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Peminjam memilih kondisi barang, denda ditentukan otomatis oleh sistem berdasarkan kondisi
        $kondisi = $request->input('kondisi_barang', 'Baik');
        
        $denda = 0;
        if ($kondisi == 'Rusak Ringan') {
            $denda = 10000;
        } elseif ($kondisi == 'Rusak Berat') {
            $denda = 50000;
        }
        
        // Simpan ke tabel pengembalian
        Pengembalian::create([
            'id_peminjaman' => $peminjaman->id_peminjaman,
            'tanggal_pengembalian' => date('Y-m-d H:i:s'),
            'terlambat_hari' => 0,
            'denda' => $denda,
            'kondisi_barang' => $kondisi,
            'catatan' => 'Dikembalikan secara mandiri melalui menu pengembalian.'
        ]);

        // Update status dan denda di tabel peminjaman
        $peminjaman->update([
            'status' => 'Dikembalikan',
            'denda' => $denda
        ]);

        return redirect(route('peminjam.pengembalian'))->with('success', 'Alat berhasil dikembalikan!');
    }
}