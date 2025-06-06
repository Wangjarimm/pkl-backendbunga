<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nis', 'nama', 'va', 'kelas', 'jurusan', 'status_pembayaran'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function tagihanSiswa()
    {
        return $this->hasMany(TagihanSiswa::class);
    }
}