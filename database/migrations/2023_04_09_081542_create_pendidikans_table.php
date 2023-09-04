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
        Schema::create('tbl_pendidikan', function (Blueprint $table) {
            $table->bigIncrements('id_pendidikan');
            $table->string('slug')->unique();
            $table->string('nama_pendidikan');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar');
            $table->text('alamat_pendidikan');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('nilai');
            $table->string('jurusan');
            $table->integer('no_urut');
            $table->string('logo');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pendidikan');
    }
};
