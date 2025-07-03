<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PembinaSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        DB::table( 'pembina' )->insert( [
            [
                'nama' => 'Pembina Satu',
                'username' => 'pembina1',
                'password' => Hash::make( 'password1' ),
                'nip' => '1985010110010001',
            ],
            [
                'nama' => 'Pembina Dua',
                'username' => 'pembina2',
                'password' => Hash::make( 'password2' ),
                'nip' => '1985020210020002',
            ],
            [
                'nama' => 'Pembina Tiga',
                'username' => 'pembina3',
                'password' => Hash::make( 'password3' ),
                'nip' => '1985030310030003',
            ],
        ] );
    }
}
