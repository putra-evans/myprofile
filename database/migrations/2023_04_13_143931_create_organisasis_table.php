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
        Schema::create('tbl_organisasi', function (Blueprint $table) {
            $table->bigIncrements('id_organisasi');
            $table->string('slug')->unique();
            $table->string('nama_organisasi');
            $table->text('tentang_organisasi');
            $table->string('tingkat_organisasi');
            $table->string('jabatan');
            $table->text('tentang_jabatan');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar');
            $table->string('logo');
            $table->string('kota');
            $table->string('provinsi');
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
        Schema::dropIfExists('organisasis');
    }
};
