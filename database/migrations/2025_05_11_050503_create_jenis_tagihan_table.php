<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jenis_tagihans', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('kelas'); // 10, 11, 12
            $table->string('nama_tagihan', 100);  // contoh: SPP, Buku, Kegiatan
            $table->decimal('nominal', 12, 2);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('jenis_tagihans');
    }
    
};
