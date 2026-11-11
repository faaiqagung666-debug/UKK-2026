<?php

namespace App\Models;

use Sakuci\Database\Model;

class Peminjaman extends Model
{
    protected static ?string $table = 'peminjaman';

    protected string $primaryKey = 'id_peminjaman';

    protected array $fillable = [
        'id_user',
        'id_alat',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'denda'
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi ke tabel alat
    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat', 'id_alat');
    }
}