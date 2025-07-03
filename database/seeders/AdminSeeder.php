<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder {
    public function run(): void {
        DB::table( 'admin' )->insert( [
            [
                'admin_name' => 'Admin Utama',
                'username' => 'admin1',
                'password' => Hash::make( 'password123' ),
                'last_login' => now()->toDateTimeString()
            ],
            [
                'admin_name' => 'Admin Kedua',
                'username' => 'admin2',
                'password' => Hash::make( 'admin456' ),
                'last_login' => now()->toDateTimeString()
            ],
            [
                'admin_name' => 'Admin Tiga',
                'username' => 'admin3',
                'password' => Hash::make( 'pass789' ),
                'last_login' => now()->toDateTimeString()
            ],
        ] );
    }
}
