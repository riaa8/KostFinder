<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';
    protected $fillable = ['nama_fasilitas', 'created_at'];

    /**
     * Mendapatkan semua kost yang memiliki fasilitas ini.
     */
    public function kosts()
    {
        return $this->belongsToMany(Kost::class, 'kost_fasilitas', 'id_fasilitas', 'id_kost');
    }
}
