<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $table = 'kosts';
    protected $fillable = ['nama', 'deskripsi', 'harga_per_bulan', 'url_gambar', 'gender', 'id_pemilik', 'created_at'];

    /**
     * Mendapatkan pemilik kost.
     */
    public function pemilik()
    {
        return $this->belongsTo(Pengguna::class, 'id_pemilik');
    }

    /**
     * Mendapatkan fasilitas yang dimiliki oleh kost.
     */
    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'kost_fasilitas', 'id_kost', 'id_fasilitas');
    }

    /**
     * Mendapatkan alamat dari kost.
     */
    public function alamat()
    {
        return $this->hasOne(Alamat::class, 'id_kost');
    }

    /**
     * Mendapatkan review dari kost.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_kost');
    }
}
