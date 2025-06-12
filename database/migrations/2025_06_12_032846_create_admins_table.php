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
     Schema::create('admin', function (Blueprint $table) {
    $table->id('admin_id');
    $table->string('admin_name', 100);
    $table->string('username', 100);
    $table->string('password', 100);
    $table->string('last_login', 20);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
