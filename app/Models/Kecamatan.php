<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = ['nama', 'kota_id'];

    public function kota(): BelongsTo
    {
        return $this->belongsTo(Kota::class);
    }

    public function kelurahan(): HasMany
    {
        return $this->hasMany(Kelurahan::class);
    }
}
