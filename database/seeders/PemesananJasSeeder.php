<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Pelanggan;
use App\Models\Jas;
use App\Models\PemesananJas;
class PemesananJasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data pelanggan dan jas yang sudah ada
        $pelanggan = Pelanggan::first();
        $jas = Jas::first();

         if ($pelanggan && $jas) {
            PemesananJas::create([
                'pelanggan_id' => $pelanggan->id,
                'jas_id' => $jas->id,
                'tanggal_sewa' => now(),
                'tanggal_kembali' => now()->addDays(2),
                'tanggal_sidang' => now()->addDays(3),
                'jumlah' => 1,
                'total_harga' => $jas->harga_sewa_per_hari * 2,
                'denda' => 0,
                'status' => 'booking',
                'pembayaran' => 'belum_bayar',
                'catatan' => 'Pemesanan pertama',
            ]);
        }
    }
}
