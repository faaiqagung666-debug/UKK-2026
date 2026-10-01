<?php

namespace App\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\alat;
use Sakuci\Controller;
use Sakuci\Http\Request;

class PengembalianController extends Controller
{
    // ==========================================
    // BAGIAN ADMIN: KELOLA SEMUA PENGEMBALIAN
    // ==========================================

    // Menampilkan semua daftar pengembalian untuk admin
    public function index(Request $request)
    {
        $datap = Pengembalian::orderBy(
            'id_pengembalian',
            'desc'
        )->paginate(10);

        $peminjaman = Peminjaman::all();
        $users = User::all();
        $alats = Alat::all();

        // Daftar peminjaman
        $peminjamanList = [];

        foreach ($peminjaman as $p) {

            $pid = $p->id_peminjaman ?? $p->id;

            $peminjamanList[$pid] = $p;
        }

        // Daftar user
        $userList = [];

        foreach ($users as $u) {

            $id = $u->id ?? $u->id_user;

            $userList[$id] =
                $u->username
                ?? $u->nama
                ?? "User #{$id}";
        }

        // Daftar alat
        $alatList = [];

        foreach ($alats as $a) {

            $id = $a->id_alat ?? $a->id;

            $alatList[$id] =
                $a->nama_alat
                ?? "Alat #{$id}";
        }

        return view(
            'pengembalian.index',
            compact(
                'datap',
                'peminjamanList',
                'userList',
                'alatList'
            )
        );
    }


    // ==========================================
    // FORM TAMBAH PENGEMBALIAN
    // ==========================================

    public function create(Request $request)
    {
        /*
        | Hanya tampilkan peminjaman yang belum dikembalikan
        */

        $peminjaman = Peminjaman::where(
            'status',
            '!=',
            'Dikembalikan'
        )->get();

        $users = User::all();
        $alats = Alat::all();

        // Daftar user
        $userList = [];

        foreach ($users as $u) {

            $id = $u->id ?? $u->id_user;

            $userList[$id] =
                $u->username
                ?? $u->nama
                ?? "User #{$id}";
        }

        // Daftar alat
        $alatList = [];

        foreach ($alats as $a) {

            $id = $a->id_alat ?? $a->id;

            $alatList[$id] =
                $a->nama_alat
                ?? "Alat #{$id}";
        }

        return view(
            'pengembalian.create',
            compact(
                'peminjaman',
                'userList',
                'alatList'
            )
        );
    }


    // ==========================================
    // SIMPAN PENGEMBALIAN BARU
    // ==========================================

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_peminjaman' => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'terlambat_hari' => 'nullable|integer|min:0',
            'denda' => 'nullable|integer|min:0',
            'kondisi_barang' => 'nullable|string|max:100',
            'catatan' => 'nullable|string',
        ]);

        /*
        | Nilai default
        */

        $validatedData['terlambat_hari'] =
            $validatedData['terlambat_hari'] ?? 0;

        $validatedData['denda'] =
            $validatedData['denda'] ?? 0;

        $validatedData['kondisi_barang'] =
            $validatedData['kondisi_barang'] ?? 'Baik';


        /*
        | Simpan pengembalian
        */

        Pengembalian::create($validatedData);


        /*
        | Update status peminjaman
        */

        $peminjaman = Peminjaman::where(
            'id_peminjaman',
            $validatedData['id_peminjaman']
        )->first();

        if ($peminjaman) {

            $peminjaman->update([
                'status' => 'Dikembalikan'
            ]);
        }


        return redirect(
            route('pengembalian.index')
        )->with(
            'success',
            'Data pengembalian berhasil ditambahkan.'
        );
    }


    // ==========================================
    // FORM EDIT PENGEMBALIAN
    // ==========================================

    public function edit(Request $request, $id_pengembalian)
    {
        /*
        | Ambil data pengembalian
        */

        $datap = Pengembalian::where(
            'id_pengembalian',
            $id_pengembalian
        )->first();


        /*
        | Jika data tidak ditemukan
        */

        if (!$datap) {

            return redirect(
                route('pengembalian.index')
            )->with(
                'error',
                'Data pengembalian tidak ditemukan.'
            );
        }


        /*
        | Ambil peminjaman yang terkait
        |
        | Gunakan where()->first(), bukan find(),
        | agar konsisten dengan PeminjamanController.
        */

        $peminjamanData = Peminjaman::where(
            'id_peminjaman',
            $datap->id_peminjaman
        )->first();


        /*
        | Blade membutuhkan $peminjaman sebagai iterable.
        |
        | Jadi object peminjaman dibungkus ke dalam array.
        */

        $peminjaman = [];

        if ($peminjamanData) {

            $peminjaman[] = $peminjamanData;
        }


        /*
        | Nilai default
        */

        $peminjamName = '-';

        $alatName = '-';


        /*
        | Ambil informasi user dan alat
        */

        if ($peminjamanData) {

            /*
            | User / Peminjam
            */

            $user = User::where(
                'id',
                $peminjamanData->id_user
            )->first();

            /*
            | Beberapa struktur database mungkin menggunakan id_user
            | sebagai primary key, jadi fallback tetap disediakan.
            */

            if (!$user) {

                $user = User::where(
                    'id_user',
                    $peminjamanData->id_user
                )->first();
            }


            if ($user) {

                $peminjamName =
                    $user->username
                    ?? $user->nama
                    ?? ('User #' . $peminjamanData->id_user);

            } else {

                $peminjamName =
                    'User #' . $peminjamanData->id_user;
            }


            /*
            | Alat
            */

            $alat = Alat::where(
                'id_alat',
                $peminjamanData->id_alat
            )->first();


            /*
            | Fallback apabila tabel menggunakan id
            */

            if (!$alat) {

                $alat = Alat::where(
                    'id',
                    $peminjamanData->id_alat
                )->first();
            }


            if ($alat) {

                $alatName =
                    $alat->nama_alat
                    ?? ('Alat #' . $peminjamanData->id_alat);

            } else {

                $alatName =
                    'Alat #' . $peminjamanData->id_alat;
            }
        }


        /*
        | Kirim data ke Blade
        */

        return view(
            'pengembalian.edit',
            compact(
                'datap',
                'peminjaman',
                'peminjamName',
                'alatName'
            )
        );
    }


    // ==========================================
    // UPDATE DATA PENGEMBALIAN
    // ==========================================

    public function update(Request $request, $id_pengembalian)
    {
        $validatedData = $request->validate([
            'id_peminjaman' => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'terlambat_hari' => 'nullable|integer|min:0',
            'denda' => 'nullable|integer|min:0',
            'kondisi_barang' => 'nullable|string|max:100',
            'catatan' => 'nullable|string',
        ]);


        /*
        | Cari data pengembalian
        */

        $pengembalian = Pengembalian::where(
            'id_pengembalian',
            $id_pengembalian
        )->first();


        /*
        | Jika tidak ditemukan
        */

        if (!$pengembalian) {

            return redirect(
                route('pengembalian.index')
            )->with(
                'error',
                'Data pengembalian tidak ditemukan.'
            );
        }


        /*
        | Update data
        */

        $pengembalian->update($validatedData);


        /*
        | Pastikan peminjaman yang terkait berstatus
        | Dikembalikan.
        */

        $peminjaman = Peminjaman::where(
            'id_peminjaman',
            $validatedData['id_peminjaman']
        )->first();


        if ($peminjaman) {

            $peminjaman->update([
                'status' => 'Dikembalikan'
            ]);
        }


        return redirect(
            route('pengembalian.index')
        )->with(
            'success',
            'Data pengembalian berhasil diubah.'
        );
    }


    // ==========================================
    // HAPUS DATA PENGEMBALIAN
    // ==========================================

    public function delete(Request $request, $id_pengembalian)
    {
        $pengembalian = Pengembalian::where(
            'id_pengembalian',
            $id_pengembalian
        )->first();


        if (!$pengembalian) {

            return redirect(
                route('pengembalian.index')
            )->with(
                'error',
                'Data pengembalian tidak ditemukan.'
            );
        }


        $pengembalian->delete();


        return redirect(
            route('pengembalian.index')
        )->with(
            'success',
            'Data pengembalian berhasil dihapus.'
        );
    }


    // ==========================================
    // BAGIAN PETUGAS
    // ==========================================

    public function indexPetugas(Request $request)
    {
        $datap = Pengembalian::orderBy(
            'id_pengembalian',
            'desc'
        )->paginate(10);

        return view(
            'petugas.pengembalian.index',
            compact('datap')
        );
    }


    // ==========================================
    // BAGIAN PEMINJAM
    // ==========================================

    public function indexPeminjamPengembalian(Request $request)
    {
        $currentUser = User::current();


        if (!$currentUser) {

            return redirect(
                route('login')
            )->with(
                'error',
                'Silakan login terlebih dahulu.'
            );
        }


        $datap = Peminjaman::where(
            'id_user',
            $currentUser->id
        )
        ->whereIn(
            'status',
            [
                'Disetujui',
                'Dipinjam'
            ]
        )
        ->orderBy(
            'id_peminjaman',
            'desc'
        )
        ->paginate(5);


        return view(
            'peminjam.pengembalian',
            compact('datap')
        );
    }


    // ==========================================
    // PROSES PENGEMBALIAN OLEH PEMINJAM
    // ==========================================

    public function storePeminjamPengembalian(
        Request $request,
        $id
    ) {

        /*
        | Cari peminjaman
        */

        $peminjaman = Peminjaman::where(
            'id_peminjaman',
            $id
        )->first();


        if (!$peminjaman) {

            return redirect(
                route('peminjam.pengembalian')
            )->with(
                'error',
                'Data peminjaman tidak ditemukan.'
            );
        }


        /*
        | Kondisi barang
        */

        $kondisi = $request->input(
            'kondisi_barang',
            'Baik'
        );


        /*
        | Hitung denda berdasarkan kondisi
        */

        $denda = 0;


        if ($kondisi == 'Rusak Ringan') {

            $denda = 10000;

        } elseif ($kondisi == 'Rusak Berat') {

            $denda = 50000;
        }


        /*
        | Simpan pengembalian
        */

        Pengembalian::create([
            'id_peminjaman' =>
                $peminjaman->id_peminjaman,

            'tanggal_pengembalian' =>
                date('Y-m-d H\:i:s'),

            'terlambat_hari' =>
                0,

            'denda' =>
                $denda,

            'kondisi_barang' =>
                $kondisi,

            'catatan' =>
                'Dikembalikan secara mandiri melalui menu pengembalian.'
        ]);


        /*
        | Update status peminjaman
        */

        $peminjaman->update([
            'status' =>
                'Dikembalikan',

            'denda' =>
                $denda
        ]);


        return redirect(
            route('peminjam.pengembalian')
        )->with(
            'success',
            'Alat berhasil dikembalikan!'
        );
    }
}