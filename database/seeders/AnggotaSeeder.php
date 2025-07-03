<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnggotaSeeder extends Seeder {
    public function run(): void {
        DB::table( 'anggota' )->insert( [
            [
                'id_pembina' => 1, // Sesuaikan dengan ID yang ada di tabel pembina
                'nama' => 'Anggota Satu',
                'username' => 'anggota1',
                'password' => Hash::make( 'password1' ),
                'nis' => '1234567890',
                'kelas' => '10A',
            ],
            [
                'id_pembina' => 1,
                'nama' => 'Anggota Dua',
                'username' => 'anggota2',
                'password' => Hash::make( 'password2' ),
                'nis' => '1234567891',
                'kelas' => '10B',
            ],
            [
                'id_pembina' => 2,
                'nama' => 'Anggota Tiga',
                'username' => 'anggota3',
                'password' => Hash::make( 'password3' ),
                'nis' => '1234567892',
                'kelas' => '10C',
            ],
        ] );
    }
}
