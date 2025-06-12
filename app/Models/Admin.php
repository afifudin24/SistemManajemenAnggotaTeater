<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model {
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    public $timestamps = false;
    protected $fillable = [
        'admin_name',
        'username',
        'password',
        'last_login',
    ];
}
