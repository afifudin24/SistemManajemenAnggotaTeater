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
       Schema::create('anggota', function (Blueprint $table) {
    $table->id('id_anggota');
    $table->string('nama', 100);
    $table->string('username', 100);
    $table->string('password', 100);
    $table->string('nis', 10);
    $table->string('kelas', 10);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
