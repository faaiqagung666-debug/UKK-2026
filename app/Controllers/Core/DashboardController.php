<?php

namespace App\Controllers\Core;

use App\Models\User;
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
            return view('peminjam.dashboard', ['user' => $user]);
        }
    }

    public function admin()
    {
        return view('core.admin.dashboard', ['user' => User::current()]);
    }
}