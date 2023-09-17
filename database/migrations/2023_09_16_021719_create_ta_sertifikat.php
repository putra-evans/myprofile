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
        Schema::create('ta_sertifikat', function (Blueprint $table) {
            $table->bigIncrements('id_sertifikat');
            $table->bigInteger('id_kategori');
            $table->string('slug')->unique();
            $table->string('nama_sertifikat');
            $table->string('tahun_sertifikat');
            $table->string('tentang_sertifikat');
            $table->string('file_projek');
            $table->integer('no_urut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ta_sertifikat');
    }
};
