<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisTagihan extends Model
{
    protected $fillable = ['kelas', 'nama_tagihan', 'nominal'];

    public function tagihanSiswa(): HasMany
    {
        return $this->hasMany(TagihanSiswa::class);
    }
}

