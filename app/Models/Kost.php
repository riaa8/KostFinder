<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kost extends Model
{
    // Nama tabel eksplisit (jika diperlukan)
    protected $table = 'kosts';

    // Field yang bisa diisi massal
    protected $fillable = [
        'owner_id',
        'name',
        'alamat',
        'harga',
        'fasilitas',
        'gender',
        'status',
    ];

    /**
     * Relasi ke User sebagai pemilik kost
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Relasi ke tabel favorites
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'kost_id');
    }

    /**
     * Relasi ke tabel reviews
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'kost_id');
    }

    /**
     * Relasi ke tabel reports
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'kost_id');
    }
}
