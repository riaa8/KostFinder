<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    //
    protected $fillable = ['user_id', 'kost_id', 'report_text', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class);
    }
}
