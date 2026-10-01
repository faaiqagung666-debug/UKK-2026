<?php

use App\Controllers\Core\AuthController;
use App\Controllers\Core\DashboardController;
use App\Controllers\Core\DatabaseController;
use App\Controllers\Core\DocsController;
use App\Controllers\Core\RoleController;
use App\Controllers\Core\UserController;
use App\Controllers\KategoriController;
use App\Controllers\alatController;
use App\Controllers\PeminjamanController;
use App\Controllers\ActivityLogController;
use Sakuci\Route;

/*
|--------------------------------------------------------------------------
| Route Web
|--------------------------------------------------------------------------
| Daftarkan seluruh route aplikasi di sini.
|
| Cara menulis action:
|   [HomeController::class, 'index']   -> disarankan
|   'HomeController@index'             -> namespace App\Controllers otomatis
|   function () { ... }                -> closure
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/docs', [DocsController::class, 'index'])->name('docs');

/*
|--------------------------------------------------------------------------
| Login multi-role
|--------------------------------------------------------------------------
| Lihat /docs untuk penjelasan lengkap langkah demi langkah.
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/logs', [ActivityLogController::class, 'index'])->name('admin.logs.index');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt')->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');

    Route::get('/database/export', [DatabaseController::class, 'export'])->name('admin.database.export');
    Route::get('/kategori/create',[App\Controllers\KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori',[App\Controllers\KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id_kategori}/edit',[App\Controllers\KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id_kategori}',[App\Controllers\KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id_kategori}',[App\Controllers\KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/alat', [alatController::class, 'index'])->name('alat.index');
    Route::get('/alat/create', [alatController::class, 'create'])->name('alat.create');
    Route::post('/alat/store', [alatController::class, 'store'])->name('alat.store');
    Route::get('/alat/{id_alat}/edit', [alatController::class, 'edit'] )->name('alat.edit');
    Route::put('/alat/{id_alat}', [alatController::class, 'update'] )->name('alat.update');
    Route::delete('/alat/{id_alat}', [alatController::class, 'delete'] )->name('alat.delete');

    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/peminjaman/{id}/update', [PeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::delete('/peminjaman/{id}/delete', [PeminjamanController::class, 'delete'])->name('peminjaman.delete');

   Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::get('/pengembalian/{id_pengembalian}/edit', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
    Route::put('/pengembalian/{id_pengembalian}/update', [PengembalianController::class, 'update'])->name('pengembalian.update');
    Route::delete('/pengembalian/{id_pengembalian}/delete', [PengembalianController::class, 'delete'])->name('pengembalian.delete');
  });

/*
|--------------------------------------------------------------------------
| Route role dinamis
|--------------------------------------------------------------------------
| Blok di bawah ini dikelola otomatis oleh RoleController saat admin
| menambah, mengganti nama, atau menghapus role lewat /admin/roles.
*/
// @generated-roles:start



// @role:petugas:start
Route::group(['prefix' => 'petugas', 'middleware' => 'petugas'], function () {
    // 1. Dashboard Utama Petugas
    Route::get('/', [DashboardController::class, 'index'])->name('petugas.dashboard');
    
    // 2. Fitur Kendali Peminjaman oleh Petugas
    Route::get('/peminjaman', [PeminjamanController::class, 'indexPetugas'])->name('petugas.peminjaman.index');
    Route::put('/peminjaman/{id}/status', [PeminjamanController::class, 'updateStatusPetugas'])->name('petugas.peminjaman.status');
    Route::get('/peminjaman/cetak', [PeminjamanController::class, 'cetakPetugas'])->name('petugas.peminjaman.cetak');
    
    // 3. Fitur Kendali Pengembalian oleh Petugas
    Route::get('/petugas/pengembalian', [App\Controllers\PengembalianController::class, 'indexPetugas'])->name('petugas.pengembalian.index');
    Route::get('/pengembalian/create', [App\Controllers\PengembalianController::class, 'create'])->name('petugas.pengembalian.create');
    Route::post('/pengembalian/store', [App\Controllers\PengembalianController::class, 'store'])->name('petugas.pengembalian.store');
});
// @role:petugas:end

// @role:peminjam:start
Route::group(['prefix' => 'peminjam', 'middleware' => 'peminjam'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('peminjam.dashboard');
    
    // Route khusus melihat katalog/daftar alat
    Route::get('/daftar-alat', [AlatController::class, 'daftarAlatPeminjam'])->name('peminjam.alat');

    // Rute khusus pengguna/peminjam mengajukan peminjaman alat
    Route::get('/peminjaman', [PeminjamanController::class, 'indexPeminjam'])->name('peminjam.indexPeminjam');
    Route::get('/peminjaman/ajukan', [PeminjamanController::class, 'createPeminjam'])->name('peminjam.createPeminjam');
    Route::post('/peminjaman/ajukan', [PeminjamanController::class, 'storePeminjam'])->name('peminjam.storePeminjam');
    Route::get('/riwayat-peminjaman', [PeminjamanController::class, 'indexPeminjam'])->name('peminjam.riwayat');

    // Route Pengembalian Khusus Peminjam (Halaman & Proses)
    Route::get('/pengembalian', [App\Controllers\PengembalianController::class, 'indexPeminjamPengembalian'])->name('peminjam.pengembalian');
    Route::post('/pengembalian/{id}', [App\Controllers\PengembalianController::class, 'storePeminjamPengembalian'])->name('peminjam.pengembalian.store');
});
// @role:peminjam:end

// @generated-roles:end
/*
|--------------------------------------------------------------------------
| Contoh (hapus/ubah sesuai kebutuhan)
|--------------------------------------------------------------------------
|
| use App\Controllers\BukuController;
|
| Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
|
| // Tujuh route CRUD sekaligus: index, create, store, show, edit, update, destroy
| // Route::resource
|
| // Group dengan prefix dan middleware bersama
| Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
|     Route::get('/dashboard', [DashboardController::class, 'index']);
| });
*/

