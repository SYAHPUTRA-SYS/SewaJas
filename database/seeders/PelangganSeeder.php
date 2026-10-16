<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Pelanggan;
class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelanggan::create([
            'nim' => '210170811',
            'nama' => 'Ari Syahputra',
            'jenis_kelamin' => 'L',
            'no_hp' => '083842044340',
            'email' => 'ary@gmail.com',
            'jurusan' => 'Teknik Informatika',
            'alamat' => 'Batuphat Timur',
        ]);

        Pelanggan::create([
            'nim' => '210170262',
            'nama' => 'Siti Rahayu',
            'jenis_kelamin' => 'P',
            'no_hp' => '08129876543',
            'email' => 'siti@gmail.com',
            'jurusan' => 'Teknik Industri',
            'alamat' => 'Batuphat Barat',
        ]);
    }
}
