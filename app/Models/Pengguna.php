<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $fillable = ['nama', 'email', 'kata_sandi', 'role', 'no_phone', 'created_at'];

    /**
     * Mendapatkan semua kost yang dimiliki oleh pengguna (pemilik).
     */
    public function kosts()
    {
        return $this->hasMany(Kost::class, 'id_pemilik');
    }

    /**
     * Mendapatkan semua review yang diberikan oleh pengguna.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_pengguna');
    }
}
