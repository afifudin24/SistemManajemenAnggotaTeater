<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model {
    /** @use HasFactory<\Database\Factories\JadwalFactory> */
    use HasFactory;
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    public $timestamps = false;
    protected $fillable = [
        'id_pembina',
        'kegiatan',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',

    ];

    // buat relasi dengan pembina

    public function pembina() {
        return $this->belongsTo( Pembina::class, 'id_pembina' );
    }

    public function kehadiran() {
        return $this->hasMany( Kehadiran::class, 'id_jadwal' );
    }
}
