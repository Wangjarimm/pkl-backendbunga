<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TagihanSiswa extends Model
{
    protected $fillable = ['siswa_id', 'jenis_tagihan_id', 'status', 'tanggal_tagihan'];

    public function jenisTagihan()
    {
        return $this->belongsTo(JenisTagihan::class, 'jenis_tagihan_id');
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
