<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BendaharaSeeder extends Seeder {
    public function run(): void {
        DB::table( 'bendahara' )->insert( [
            [
                'nama' => 'Bendahara Satu',
                'username' => 'bendahara1',
                'password' => Hash::make( 'password1' ),
                'periode' => '2023/2024',
            ],
            [
                'nama' => 'Bendahara Dua',
                'username' => 'bendahara2',
                'password' => Hash::make( 'password2' ),
                'periode' => '2024/2025',
            ],
            [
                'nama' => 'Bendahara Tiga',
                'username' => 'bendahara3',
                'password' => Hash::make( 'password3' ),
                'periode' => '2025/2026',
            ],
        ] );
    }
}
