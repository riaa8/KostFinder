<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    // Nama tabel jika tidak sesuai konvensi Laravel
    protected $table = 'favorites';

    // Mass assignable fields
    protected $fillable = ['user_id', 'kost_id'];

    /**
     * Relasi ke model User
     * Satu favorite dimiliki oleh satu user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke model Kost
     * Satu favorite terkait ke satu kost
     */
    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class, 'kost_id');
    }
}
