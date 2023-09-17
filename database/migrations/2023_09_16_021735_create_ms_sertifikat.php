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
        Schema::create('ms_sertifikat', function (Blueprint $table) {
            $table->bigIncrements('id_kategori');
            $table->string('slug')->unique();
            $table->string('nama_kategori');
            $table->text('keterangan_kategori');
            $table->integer('no_urut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_sertifikat');
    }
};
