<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'tagihan_siswa_id',
        'jumlah_bayar',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}

