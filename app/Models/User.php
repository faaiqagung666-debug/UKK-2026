<?php

namespace App\Models;

use Sakuci\Database\Model;
use Sakuci\Session;

class User extends Model
{
    protected static ?string $table = 'users';

    protected string $primaryKey = 'id'; // Sesuaikan jika primary key tabel users Anda berbeda (misal 'id_user')

    // Tambahkan 'nama' (atau kolom nama yang ada di database Anda)
    protected array $fillable = [
        'nama',
        'username',
        'password',
        'role'
    ];

    protected array $hidden = ['password'];

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role, $roles, true);
    }

    public static function current(): ?static
    {
        static $user = null;
        static $resolved = false;

        if (! $resolved) {
            $resolved = true;

            if (Session::has('user_id')) {
                $user = static::find(Session::get('user_id'));
            }
        }

        return $user;
    }
}