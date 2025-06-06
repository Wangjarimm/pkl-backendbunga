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
        Schema::create('tagihan_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('jenis_tagihan_id')->constrained('jenis_tagihans')->onDelete('cascade');
            $table->enum('status', ['lunas', 'belum lunas'])->default('belum lunas');
            $table->date('tanggal_tagihan')->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('tagihan_siswas');
    }
    
};
