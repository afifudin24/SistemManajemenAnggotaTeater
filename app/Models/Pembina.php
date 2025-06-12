<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembina extends Model {
    /** @use HasFactory<\Database\Factories\PembinaFactory> */
    use HasFactory;
    protected $table = 'pembina';
    protected $primaryKey = 'id_pembina';

    public $timestamps = false;
    protected $fillable = [
        'nama',
        'username',
        'password',
        'nip',
    ];

    public function jadwal() {
        return $this->hasMany( Jadwal::class, 'id_pembina' );
    }
}
