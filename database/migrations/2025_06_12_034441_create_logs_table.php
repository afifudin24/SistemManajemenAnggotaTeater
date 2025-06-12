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
      Schema::create('log_aktifitas', function (Blueprint $table) {
    $table->id('id_log');
    $table->unsignedBigInteger('id_user');
    $table->enum('jenis_user', ['admin', 'pembina', 'bendahara', 'anggota']);
    $table->string('aktivitas', 100);
    $table->timestamp('waktu');
    $table->string('ip_address', 45);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
