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
        Schema::create('ta_projek', function (Blueprint $table) {
            $table->bigIncrements('id_projek');
            $table->bigInteger('id_bhs_pemograman');
            $table->string('slug')->unique();
            $table->string('nama_projek');
            $table->string('tahun_pembuatan');
            $table->string('tentang_projek');
            $table->string('file');
            $table->integer('no_urut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ta_projek');
    }
};
