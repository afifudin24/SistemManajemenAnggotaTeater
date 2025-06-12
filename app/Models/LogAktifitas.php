<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktifitas extends Model {
    /** @use HasFactory<\Database\Factories\LogFactory> */
    use HasFactory;
    protected $table = 'log_aktifitas';
    protected $primaryKey = 'id_log';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'jenis_user',
        'aktivitas',
        'waktu',
        'ip_address',
    ];
}
