<?php

namespace App\Controllers\Core;

use App\Models\Role;
use App\Models\User;
use Sakuci\Controller;
use Sakuci\Http\Request;
use Sakuci\Session;
use App\Models\ActivityLog;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('core.auth.login');
    }

    public function showRegister()
    {
        $roles = Role::where('can_register', 1)->orderBy('name')->get();

        if ($roles === []) {
            return redirect('/login')->with('error', 'Pendaftaran belum dibuka.');
        }

        return view('core.auth.register', ['roles' => $roles]);
    }

    public function register(Request $request)
    {
        $allowed = Role::where('can_register', 1)->pluck('name');

        if ($allowed === []) {
            return redirect('/login')->with('error', 'Pendaftaran belum dibuka.');
        }

        $data = $request->validate([
            'username' => 'required|min:3|max:50|alpha_dash|unique:users,username',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:' . implode(',', $allowed),
        ]);

        $user = User::create([
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role'     => $data['role'],
        ]);

        Session::put('user_id', $user->id);

        // Catat aktivitas registrasi/masuk pertama kali
        ActivityLog::create([
            'user_id' => $user->id,
            'activity' => 'Melakukan pendaftaran akun baru dan masuk ke sistem',
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null
        ]);

        return redirect('/dashboard')->with('success', 'Pendaftaran berhasil. Selamat datang, ' . $user->username . '.');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::firstWhere('username', $data['username']);

        if (! $user || ! password_verify($data['password'], $user->password)) {
            return back()
                ->withErrors(['username' => 'Username atau password salah.'])
                ->withInput();
        }

        Session::put('user_id', $user->id);

        // --- CATAT AKTIVITAS LOGIN DI SINI ---
        ActivityLog::create([
            'user_id' => $user->id,
            'activity' => 'Berhasil masuk (login) ke dalam sistem',
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null
        ]);
        // -------------------------------------

        return redirect($user->role === 'admin' ? '/admin' : '/dashboard')
            ->with('success', 'Selamat datang, ' . $user->username . '.');
    }

    public function logout()
    {
        $userId = Session::get('user_id');

        if ($userId) {
            // Catat aktivitas logout sebelum sesi dihapus
            ActivityLog::create([
                'user_id' => $userId,
                'activity' => 'Keluar (logout) dari sistem',
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null
            ]);
        }

        Session::forget('user_id');

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}