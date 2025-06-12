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
       Schema::create('kehadiran', function (Blueprint $table) {
    $table->id('id_kehadiran');
    $table->unsignedBigInteger('id_jadwal');
    $table->unsignedBigInteger('id_anggota');
    $table->dateTime('waktu_pencatatan');
    $table->text('catatan');

    $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal')->onDelete('cascade');
    $table->foreign('id_anggota')->references('id_anggota')->on('anggota')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadirans');
    }
};
