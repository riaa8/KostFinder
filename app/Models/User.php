<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    //
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'no_phone', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relasi: Pemilik bisa punya banyak kost
    public function kosts(): HasMany
    {
        return $this->hasMany(Kost::class, 'owner_id');
    }

    // Relasi: Pencari bisa punya banyak favorite
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
