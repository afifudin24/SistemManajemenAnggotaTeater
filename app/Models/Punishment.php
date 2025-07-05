<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Punishment extends Model {
    /** @use HasFactory<\Database\Factories\PunishmentFactory> */
    use HasFactory;
    protected $table = 'punishment';
    protected $primaryKey = 'id_punishment';

    public $timestamps = false;
    protected $fillable = [
        'id_anggota',
        'id_pembina',
        'tanggal',
        'karya',
        'status_punishment'
    ];

    public function anggota() {
        return $this->belongsTo( Anggota::class, 'id_anggota' );
    }

    public function pembina() {
        return $this->belongsTo( Pembina::class, 'id_pembina' );
    }

}
