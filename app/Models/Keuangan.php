<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model {
    /** @use HasFactory<\Database\Factories\KeuanganFactory> */
    use HasFactory;
    protected $table = 'keuangan';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'id_bendahara',
        'jenis',
        'tanggal',
        'jumlah',
        'keterangan',
        'bukti_transaksi',
    ];

    public function bendahara() {
        return $this->belongsTo( Bendahara::class, 'id_bendahara' );
    }
}
