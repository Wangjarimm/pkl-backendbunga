<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'payment_id',
        'amount',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}

