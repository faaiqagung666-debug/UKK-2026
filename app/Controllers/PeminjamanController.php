<?php

namespace App\Controllers;

use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\User;
use Sakuci\Http\Request;

class PeminjamanController
{
    // ==========================================
    // BAGIAN ADMIN: Kelola Semua Peminjaman
    // ==========================================

    public function index(Request $request)
    {
        // Wajib menggunakan with(['user', 'alat']) agar data relasinya ikut dimuat
        $datap = Peminjaman::with(['user', 'alat'])->orderBy('id_peminjaman', 'desc')->paginate(4);
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
        
        if (!isset($data['status'])) {
            $data['status'] = 'Pending';
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
    // BAGIAN PETUGAS & PEMINJAM
    // ==========================================

    public function indexPetugas(Request $request)
    {
        $datap = Peminjaman::with(['user', 'alat'])->orderBy('id_peminjaman', 'desc')->paginate(10);
        return view('petugas.peminjaman.index', compact('datap'));
    }

    public function updateStatusPetugas(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();
        if (!$peminjaman) {
            return redirect(route('petugas.peminjaman.index'))->with('error', 'Data peminjaman tidak ditemukan.');
        }

        $peminjaman->status = $request->input('status');
        $peminjaman->save();

        return redirect(route('petugas.peminjaman.index'))->with('success', 'Status peminjaman berhasil diperbarui!');
    }

    public function cetakPetugas(Request $request)
    {
        $datap = Peminjaman::with(['user', 'alat'])->orderBy('id_peminjaman', 'desc')->get();
        return view('petugas.peminjaman.cetak', compact('datap'));
    }

    public function indexPeminjam(Request $request)
    {
        $currentUser = User::current();
        
        if (!$currentUser) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $datap = Peminjaman::with(['user', 'alat'])
                         ->where('id_user', $currentUser->id)
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
        
        $data['id_user'] = $currentUser->id;
        $data['status'] = 'Pending';

        Peminjaman::create($data);

        return redirect(route('peminjam.indexPeminjam'))->with('success', 'Pengajuan peminjaman berhasil dikirim dan masuk ke daftar riwayat!');
    }
}