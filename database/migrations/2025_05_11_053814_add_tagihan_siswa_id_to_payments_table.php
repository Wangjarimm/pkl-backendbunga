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
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('tagihan_siswa_id')->nullable()->after('id');
            $table->foreign('tagihan_siswa_id')->references('id')->on('tagihan_siswas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['tagihan_siswa_id']);
            $table->dropColumn('tagihan_siswa_id');
        });
    }
};
