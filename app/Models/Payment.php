<?php

// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'nama',
        'kelas',
        'jurusan',
        'va_number',
        'note',
        'amount',
        'tanggal_setor',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
