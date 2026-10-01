<?php

namespace App\Models;

use Sakuci\Database\Model;

class ActivityLog extends Model
{
    protected static ?string $table = 'activity_logs';

    protected array $fillable = [
        'user_id',
        'activity',
        'ip_address'
    ];

    /** Relasi ke model User */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}