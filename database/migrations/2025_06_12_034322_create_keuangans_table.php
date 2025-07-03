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
        Schema::create('keuangan', function (Blueprint $table) {
    $table->id('id_transaksi');
    $table->unsignedBigInteger('id_bendahara');
    $table->enum('jenis', ['pemasukan', 'pengeluaran']);
    $table->date('tanggal');
    $table->decimal('jumlah', 15, 2);
    $table->text('keterangan');
    $table->string('bukti_transaksi', 100);
    $table->foreign('id_bendahara')->references('id_bendahara')->on('bendahara')->onDelete('cascade');
});
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};