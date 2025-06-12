<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model {
    /** @use HasFactory<\Database\Factories\AnggotaFactory> */
    use HasFactory;
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'nis',
        'kelas',
    ];

    public function kehadiran() {
        return $this->hasMany( Kehadiran::class, 'id_anggota' );
    }
}
