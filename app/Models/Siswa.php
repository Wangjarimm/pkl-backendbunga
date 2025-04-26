<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nis', 'nama', 'kelas', 'status_pembayaran'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}