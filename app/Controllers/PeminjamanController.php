<?php

namespace App\Controllers;

use App\Models\Peminjaman;
use App\Models\alat;
use App\Models\User;
use Sakuci\Http\Request;

class PeminjamanController
{
    // ==========================================
    // BAGIAN ADMIN: Kelola Semua Peminjaman
    // ==========================================

    public function index(Request $request)
    {
        $datap = Peminjaman::orderBy('id_peminjaman', 'desc')->paginate(4);
        return view('peminjaman.index', compact('datap'));
    }

    public function create(Request $request)
    {
        $alat = Alat::all();
        $users = User::all();
        return view('peminjaman.create', compact('alat', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        // Pastikan id_alat dan id_user terisi
        if (empty($data['id_alat']) || empty($data['id_user'])) {
            return redirect()->back()->with('error', 'Silakan pilih user dan alat terlebih dahulu.');
        }

        // Set status default jika belum ada
        if (empty($data['status'])) {
            $data['status'] = 'Pending';
        }

        // Ubah string kosong pada tanggal_kembali menjadi null
        if (empty($data['tanggal_kembali'])) {
            $data['tanggal_kembali'] = null;
        }

        Peminjaman::create($data);

        return redirect(route('peminjaman.index'))->with('success', 'Data peminjaman berhasil ditambahkan!');
    }

    public function edit(Request $request, $id)
    {
        $data = Peminjaman::where('id_peminjaman', $id)->first();
        if (!$data) {
            return redirect(route('peminjaman.index'))->with('error', 'Data peminjaman tidak ditemukan.');
        }

        $alat = Alat::all();
        $users = User::all();
        return view('peminjaman.edit', compact('data', 'alat', 'users'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();
        if (!$peminjaman) {
            return redirect(route('peminjaman.index'))->with('error', 'Data peminjaman tidak ditemukan.');
        }

        $input = $request->all();

        if (empty($input['id_alat'])) {
            $input['id_alat'] = $peminjaman->id_alat;
        }
        if (empty($input['id_user'])) {
            $input['id_user'] = $peminjaman->id_user;
        }
        if (empty($input['tanggal_kembali'])) {
            $input['tanggal_kembali'] = null;
        }

        $peminjaman->update($input);

        return redirect(route('peminjaman.index'))->with('success', 'Data peminjaman berhasil diperbarui!');
    }

    public function delete(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();
        if ($peminjaman) {
            $peminjaman->delete();
        }

        return redirect(route('peminjaman.index'))->with('success', 'Data peminjaman berhasil dihapus!');
    }


    // ==========================================
    // BAGIAN PEMINJAM / SISWA: Pengajuan Mandiri
    // ==========================================

    public function indexPeminjam(Request $request)
    {
        $currentUser = User::current();
        
        if (!$currentUser) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $datap = Peminjaman::where('id_user', $currentUser->id)
                         ->orderBy('id_peminjaman', 'desc')
                         ->paginate(5);

        return view('peminjam.index_peminjam', compact('datap'));
    }

    public function createPeminjam(Request $request)
    {
        $alat = Alat::all();
        return view('peminjam.create_peminjam', compact('alat'));
    }

    public function storePeminjam(Request $request)
    {
        $currentUser = User::current();
        
        if (!$currentUser) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $data = $request->all();
        
        if (empty($data['id_alat'])) {
            return redirect()->back()->with('error', 'Pilih alat yang ingin dipinjam.');
        }

        $data['id_user'] = $currentUser->id ?? $currentUser->id_user;
        $data['status'] = 'Pending';
        
        if (empty($data['tanggal_kembali'])) {
            $data['tanggal_kembali'] = null;
        }

        Peminjaman::create($data);

        return redirect(route('peminjam.indexPeminjam'))->with('success', 'Pengajuan peminjaman berhasil dikirim!');
    }
}