<?php

namespace App\Models;
use Sakuci\Database\Model;

class alat extends Model
{
    protected static ?string $table = 'alat';
    protected string $primaryKey = 'id_alat';

    protected array $fillable = [
        'id_kategori',
        'nama_alat',
        'kode_alat'
    ];
}
