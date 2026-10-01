<?php

namespace App\Controllers\Core;

use App\Models\User;
use App\Models\Peminjaman;
use Sakuci\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::current();

        if (!$user) {
            return redirect()->route('login');
        }

        // =========================
        // ADMIN
        // =========================
        if ($user->role === 'admin') {
            return view('core.admin.dashboard', [
                'user' => $user
            ]);
        }

        // =========================
        // PETUGAS
        // =========================
        elseif ($user->role === 'petugas') {
            return view('petugas.dashboard', [
                'user' => $user
            ]);
        }

        // =========================
        // PEMINJAM / PENGGUNA
        // =========================
        else {

            $userId = $user->id;

            /*
             * ==========================================
             * 1. MENUNGGU
             * ==========================================
             *
             * Pengajuan yang masih menunggu persetujuan
             * admin.
             */
            $pendingCount = Peminjaman::where('id_user', $userId)
                ->where('status', 'Pending')
                ->count();


            /*
             * ==========================================
             * 2. DIPINJAM
             * ==========================================
             *
             * Status:
             * - Disetujui
             * - Dipinjam
             *
             * Keduanya masih merupakan peminjaman aktif
             * dan belum selesai dikembalikan.
             */
            $activeCount = Peminjaman::where('id_user', $userId)
                ->whereIn('status', [
                    'Disetujui',
                    'Dipinjam'
                ])
                ->count();


            /*
             * ==========================================
             * 3. SELESAI
             * ==========================================
             *
             * Di aplikasi Anda status setelah pengembalian
             * adalah "Dikembalikan", BUKAN "Selesai".
             */
            $completedCount = Peminjaman::where('id_user', $userId)
                ->where('status', 'Dikembalikan')
                ->count();


            /*
             * ==========================================
             * 4. TOTAL DENDA
             * ==========================================
             *
             * Ambil seluruh peminjaman milik user kemudian
             * jumlahkan field denda.
             *
             * Cara ini sengaja menggunakan PHP biasa karena
             * ORM Sakuci Anda sebelumnya tidak menggunakan
             * method sum() seperti Laravel Eloquent.
             */
            $totalDenda = 0;

            $peminjamans = Peminjaman::where('id_user', $userId)->get();

            foreach ($peminjamans as $peminjaman) {

                if (isset($peminjaman->denda) && $peminjaman->denda !== null) {
                    $totalDenda += (int) $peminjaman->denda;
                }
            }


            /*
             * ==========================================
             * KIRIM DATA KE DASHBOARD
             * ==========================================
             */
            return view('peminjam.dashboard', [
                'user'            => $user,
                'pendingCount'    => $pendingCount,
                'activeCount'     => $activeCount,
                'completedCount'  => $completedCount,
                'totalDenda'      => $totalDenda
            ]);
        }
    }


    public function admin()
    {
        return view('core.admin.dashboard', [
            'user' => User::current()
        ]);
    }
}