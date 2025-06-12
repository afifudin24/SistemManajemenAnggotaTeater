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
       Schema::create('pembina', function (Blueprint $table) {
    $table->id('id_pembina');
    $table->string('nama', 100);
    $table->string('username', 100);
    $table->string('password', 100);
    $table->string('nip', 20);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembinas');
    }
};
