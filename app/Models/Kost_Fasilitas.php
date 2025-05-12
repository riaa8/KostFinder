<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost_Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'kost_fasilitas';
    protected $fillable = ['id_kost', 'id_fasilitas', 'created_at'];

    /**
     * Mendapatkan kost terkait.
     */
    public function kost()
    {
        return $this->belongsTo(Kost::class, 'id_kost');
    }

    /**
     * Mendapatkan fasilitas terkait.
     */
    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'id_fasilitas');
    }
}
