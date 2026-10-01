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

        // Arahkan ke nama view yang posisinya ada di luar folder core/petugas
        if ($user->role === 'admin') {
            return view('core.admin.dashboard', ['user' => $user]);
        } 
        elseif ($user->role === 'petugas') {
            return view('petugas.dashboard', ['user' => $user]);
        } 
        else {
            // Inisialisasi default statistik peminjam
            $pendingCount = 0;
            $activeCount = 0;
            $completedCount = 0;
            $totalDenda = 0;

            if ($user) {
                $userId = $user->id;
                
                // Menghitung data statistik berdasarkan status di database
                $pendingCount   = Peminjaman::where('id_user', $userId)->where('status', 'Pending')->count();
                $activeCount    = Peminjaman::where('id_user', $userId)->where('status', 'Dipinjam')->count();
                $completedCount = Peminjaman::where('id_user', $userId)->where('status', 'Selesai')->count();
                
                // Menghitung total denda menggunakan PHP murni untuk menghindari error method sum()
                $peminjamans = Peminjaman::where('id_user', $userId)->get();
                foreach ($peminjamans as $p) {
                    $totalDenda += isset($p->denda) ? (int)$p->denda : 0;
                }
            }

            return view('peminjam.dashboard', [
                'user' => $user,
                'pendingCount' => $pendingCount,
                'activeCount' => $activeCount,
                'completedCount' => $completedCount,
                'totalDenda' => $totalDenda
            ]);
        }
    }

    public function admin()
    {
        return view('core.admin.dashboard', ['user' => User::current()]);
    }
}