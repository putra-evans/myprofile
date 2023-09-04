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
        Schema::create('tbl_pengalaman_kerja', function (Blueprint $table) {
            $table->bigIncrements('id_pengalaman');
            $table->string('slug')->unique();
            $table->string('nama_perusahaan');
            $table->date('tanggal_keluar');
            $table->date('tanggal_masuk');
            $table->string('posisi');
            $table->text('tugas_wewenang');
            $table->text('file');
            $table->string('logo');
            $table->integer('no_urut');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pengalaman_kerja');
    }
};
