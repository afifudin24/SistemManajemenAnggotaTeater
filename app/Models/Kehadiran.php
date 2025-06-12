<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model {
    /** @use HasFactory<\Database\Factories\KehadiranFactory> */
    use HasFactory;
    protected $table = 'kehadiran';
    protected $primaryKey = 'id_kehadiran';
    public $timestamps = false;

    protected $fillable = [
        'id_jadwal',
        'id_anggota',
        'waktu_pencatatan',
        'catatan',
    ];

    public function jadwal() {
        return $this->belongsTo( Jadwal::class, 'id_jadwal' );
    }

    public function anggota() {
        return $this->belongsTo( Anggota::class, 'id_anggota' );
    }
}
