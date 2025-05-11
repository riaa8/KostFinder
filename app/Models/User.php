<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use Notifiable;

    // Field yang boleh diisi secara massal
    protected $fillable = [
        'name',
        'email',
        'password',
        'no_phone',
        'role',
    ];

    // Menyembunyikan field tertentu dari array/JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast otomatis ke tipe data
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi: Pemilik bisa memiliki banyak kost (1 to many)
     */
    public function kosts(): HasMany
    {
        return $this->hasMany(Kost::class, 'owner_id');
    }

    /**
     * Relasi: Pencari bisa memiliki banyak favorit
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Relasi: User dapat memberikan banyak review
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Relasi: User dapat membuat banyak report
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Aksesor untuk format nama (opsional)
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
        );
    }
}
