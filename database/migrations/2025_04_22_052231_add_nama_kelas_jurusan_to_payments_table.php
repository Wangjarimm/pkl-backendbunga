<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('nama')->nullable()->after('siswa_id');  // Tambahkan kolom nama
            $table->string('kelas')->nullable()->after('nama'); // Tambahkan kolom kelas
            $table->string('jurusan')->nullable()->after('kelas'); // Tambahkan kolom jurusan
        });
    }
    
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('kelas');
            $table->dropColumn('jurusan');
        });
    }
};
