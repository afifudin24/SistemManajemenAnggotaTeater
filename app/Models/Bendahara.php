<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bendahara extends Model {
    /** @use HasFactory<\Database\Factories\BendaharaFactory> */
    use HasFactory;
    protected $table = 'bendahara';
    protected $primaryKey = 'id_bendahara';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'periode',
    ];

    public function keuangan() {
        return $this->hasMany( Keuangan::class, 'id_bendahara' );
    }
}
