<?php

// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagihan_siswa_id',
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

    public function tagihanSiswa()
    {
        return $this->belongsTo(TagihanSiswa::class);
    }
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class);
    }
}
