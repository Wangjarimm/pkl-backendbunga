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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('nama');
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('va_number');
            $table->string('note')->nullable();
            $table->integer('amount');
            $table->date('tanggal_setor');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->string('snap_token')->nullable();
            $table->string('order_id')->nullable();
            $table->timestamps();
    
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
