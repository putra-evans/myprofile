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
        Schema::create('tbl_profile', function (Blueprint $table) {
            $table->bigIncrements('id_profile');
            $table->string('slug')->unique();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('foto');
            $table->string('email');
            $table->string('no_hp');
            $table->string('status');
            $table->text('profil_singkat');
            $table->string('pekerjaan');
            $table->text('alamat_sekarang');
            $table->string('kota_asal');
            $table->string('provinsi_asal');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_profile');
    }
};
