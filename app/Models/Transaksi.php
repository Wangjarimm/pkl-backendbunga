<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'siswa_id',
        'nama',
        'kelas',
        'jurusan',
        'va_number',
        'note',
        'amount',
        'tanggal_setor',
        'status',
        'snap_token',
        'snap_url',
        'order_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
