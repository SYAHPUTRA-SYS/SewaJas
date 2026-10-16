<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Jas;
class JasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jas = [
            // ===== TOGA =====
            [
                'kode_jas' => 'TOGA-S-001',
                'jenis' => 'toga',
                'ukuran' => 'S',
                'stok' => 10,
                'harga_sewa_per_hari' => 50000,
                'denda_terlambat' => 50000,
                'keterangan' => 'Toga ukuran S untuk tinggi 155-160 cm',
                'is_available' => true,
            ],
            [
                'kode_jas' => 'TOGA-M-002',
                'jenis' => 'toga',
                'ukuran' => 'M',
                'stok' => 15,
                'harga_sewa_per_hari' => 50000,
                'denda_terlambat' => 50000,
                'keterangan' => 'Toga ukuran M untuk tinggi 160-170 cm',
                'is_available' => true,
            ],
            [
                'kode_jas' => 'TOGA-L-003',
                'jenis' => 'toga',
                'ukuran' => 'L',
                'stok' => 12,
                'harga_sewa_per_hari' => 50000,
                'denda_terlambat' => 50000,
                'keterangan' => 'Toga ukuran L untuk tinggi 170-180 cm',
                'is_available' => true,
            ],
            [
                'kode_jas' => 'TOGA-XL-004',
                'jenis' => 'toga',
                'ukuran' => 'XL',
                'stok' => 8,
                'harga_sewa_per_hari' => 50000,
                'denda_terlambat' => 50000,
                'keterangan' => 'Toga ukuran XL untuk tinggi 180-190 cm',
                'is_available' => true,
            ],

            // ===== JAS ALMAMATER =====
            [
                'kode_jas' => 'JAS-S-001',
                'jenis' => 'jas_almamater',
                'ukuran' => 'S',
                'stok' => 8,
                'harga_sewa_per_hari' => 75000,
                'denda_terlambat' => 75000,
                'keterangan' => 'Jas Almamater ukuran S (berat 50-60 kg)',
                'is_available' => true,
            ],
            [
                'kode_jas' => 'JAS-M-002',
                'jenis' => 'jas_almamater',
                'ukuran' => 'M',
                'stok' => 12,
                'harga_sewa_per_hari' => 75000,
                'denda_terlambat' => 75000,
                'keterangan' => 'Jas Almamater ukuran M (berat 60-70 kg)',
                'is_available' => true,
            ],
            [
                'kode_jas' => 'JAS-L-003',
                'jenis' => 'jas_almamater',
                'ukuran' => 'L',
                'stok' => 10,
                'harga_sewa_per_hari' => 75000,
                'denda_terlambat' => 75000,
                'keterangan' => 'Jas Almamater ukuran L (berat 70-80 kg)',
                'is_available' => true,
            ],
            [
                'kode_jas' => 'JAS-XL-004',
                'jenis' => 'jas_almamater',
                'ukuran' => 'XL',
                'stok' => 5,
                'harga_sewa_per_hari' => 75000,
                'denda_terlambat' => 75000,
                'keterangan' => 'Jas Almamater ukuran XL (berat 80-90 kg)',
                'is_available' => true,
            ],

            // ===== KEBAYA =====
            [
                'kode_jas' => 'KEB-S-001',
                'jenis' => 'kebaya',
                'ukuran' => 'S',
                'stok' => 5,
                'harga_sewa_per_hari' => 100000,
                'denda_terlambat' => 100000,
                'keterangan' => 'Kebaya ukuran S (lingkar dada 80-85 cm)',
                'is_available' => true,
            ],
            [
                'kode_jas' => 'KEB-M-002',
                'jenis' => 'kebaya',
                'ukuran' => 'M',
                'stok' => 8,
                'harga_sewa_per_hari' => 100000,
                'denda_terlambat' => 100000,
                'keterangan' => 'Kebaya ukuran M (lingkar dada 85-90 cm)',
                'is_available' => true,
            ],
            [
                'kode_jas' => 'KEB-L-003',
                'jenis' => 'kebaya',
                'ukuran' => 'L',
                'stok' => 3,
                'harga_sewa_per_hari' => 100000,
                'denda_terlambat' => 100000,
                'keterangan' => 'Kebaya ukuran L (lingkar dada 90-95 cm)',
                'is_available' => true,
            ],
        ];

        foreach ($jas as $item) {
            Jas::create($item);
        }
    }
}
