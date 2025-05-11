<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    // Nama tabel eksplisit (jika diperlukan)
    protected $table = 'reports';

    // Field yang dapat diisi massal
    protected $fillable = [
        'user_id',
        'kost_id',
        'report_text',
        'status',
    ];

    /**
     * Relasi ke User (yang membuat laporan)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Kost (yang dilaporkan)
     */
    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class, 'kost_id');
    }
}
