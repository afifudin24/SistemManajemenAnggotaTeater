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
      Schema::create('jadwal', function (Blueprint $table) {
    $table->id('id_jadwal');
    $table->unsignedBigInteger('id_pembina');
    $table->string('kegiatan', 100);
    $table->date('tanggal');
    $table->time('waktu_mulai');
    $table->time('waktu_selesai');
    $table->string('lokasi', 50);

    $table->foreign('id_pembina')->references('id_pembina')->on('pembina')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
