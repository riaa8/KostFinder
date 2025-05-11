<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    // Nama tabel eksplisit jika perlu
    protected $table = 'reviews';

    // Field yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'kost_id',
        'rating',
        'comment',
    ];

    /**
     * Relasi ke User (yang memberi review)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Kost (yang direview)
     */
    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class, 'kost_id');
    }
}
