<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'alamat';
    protected $fillable = ['id_kost', 'jalan', 'kota', 'provinsi', 'kode_pos', 'created_at'];

    /**
     * Mendapatkan kost terkait.
     */
    public function kost()
    {
        return $this->belongsTo(Kost::class, 'id_kost');
    }
}
