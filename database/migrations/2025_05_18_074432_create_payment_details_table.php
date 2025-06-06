<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments')->onDelete('cascade');
            $table->unsignedBigInteger('tagihan_siswa_id');
            $table->integer('jumlah_bayar');
            $table->timestamps();

            // Jika kamu punya tabel tagihan_siswa, tambahkan foreign key
            $table->foreign('tagihan_siswa_id')->references('id')->on('tagihan_siswas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
